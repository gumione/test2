<?php
namespace common\components;

use yii\base\Component;
use yii\base\Exception;
use Yii;

/**
 * Компонент реализует управление настройками.
 *
 * Class Options
 * @package app\components
 */
class Options extends Component implements \ArrayAccess
{

    // -- в секундах
    public $cacheTimeout = 60;

    private $_values = [];
    private $_divider = '.';

    public function init()
    {
        parent::init();
        //sql("select [[option_name]], [[option_value]] from {{options}} where [[autoload]]=:autoload",[':autoload' => 1])->cache($this->cacheTimeout)->queryAll();
        //$z = 5;
    }

    final public function __get( $name )
    {
        if (mb_strlen($name) <= 0) return false;
        if (array_key_exists($name, Yii::$app->params)) return Yii::$app->params[$name];
        if (strpos($name, $this->_divider) !== false) {
            foreach (explode($this->_divider, $name) as $v) {
                $v = trim($v);
                if ($v === '') throw new Exception('Wrong name ' . $name);
                if (! isset($result)) $result = $this->$v;
                else {
                    if (! is_array($result) || ! array_key_exists($v, $result))
                        return false;
                    $result = $result[$v];
                }
            }
            return $result;
        }

        if (array_key_exists($name, $this->_values)) return $this->_values[$name];

        $command = Yii::$app->db->createCommand(
            '(SELECT [[option_name]], [[option_value]] FROM {{options}} WHERE [[option_name]] = :optname) UNION ' .
            '(SELECT [[option_name]], [[option_value]] FROM {{options}} WHERE [[option_name]] LIKE :optnameLike) ORDER BY [[option_name]]',
            [
                ':optname' => $name,
                ':optnameLike' => str_replace(['%','_'], ['\\%','\\_'], $name . $this->_divider) . '%'
            ]
        );

        //if (in_array($name, ['payment', 'payout'])) $command->noCache();
        //else $command->cache($this->cacheTimeout);
        $command->noCache(); // TODO: включить кеш в случае необходимости

        $rows = $command->queryAll();

        if (empty($rows)) {
            $this->_values[$name] = false;
            return false;
        }

        $disabled_keys = [];

        foreach ($rows as $row) {
            $option_name = explode($this->_divider, trim($row['option_name'], $this->_divider));
            if (empty($option_name)) continue;
            $value = & $this->_values;
            unset($prev_value);
            $prev_key = '';
            $key_str = '.';
            $level = 0;
            foreach ($option_name as $v) {
                $v = trim($v);
                if ($v === '') continue;
                if (isset($value) && ! is_array($value) && $value !== false)
                    throw new Exception('Cannot use option ' . $row['option_name']);
                if ($v == '!disabled') {
                    if (! empty($prev_key) && ! empty($this->_eval($row))) {
                        $disabled_keys[$key_str] = true;
                        if ($level > 1) unset($prev_value[$prev_key]);
                        else $prev_value[$prev_key] = false;
                    }
                    continue 2;
                } else {
                    $prev_value = & $value;
                    $prev_key = $v;
                    $key_str .= "$v.";
                    $level++;
                    if (array_key_exists($key_str, $disabled_keys)) continue 2;
                    $value = & $value[$v];
                }
            }
            if (isset($value)) throw new Exception('Cannot use option ' . $row['option_name']);
            $value = $this->_eval($row);
        }

        return $this->_values[$name];
    }

    public function __set ( $name, $value )
    {
        $exist = sql("select count(*) from {{options}} where [[option_name]]=:optname", [':optname' => $name] )->queryScalar();
        if ($exist) {
            sql()->update('options', [ 'option_value' => $value ], 'option_name=:optname',[':optname' => $name])->execute();
        } else {
            sql()->insert('options', ['option_name' => $name, 'option_value' => $value])->execute();
        }
    }

    public function offsetExists($offset)
    {
        throw new Exception('Cannot check option');
    }

    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {
        throw new Exception('Cannot set option via array access');
    }

    public function offsetUnset($offset)
    {
        throw new Exception('Cannot unset option');
    }

    private function _eval($row)
    {
        if (! is_array($row)) return false;
        if (! empty($row['eval'])) {
            try {
                $func = function ($value) {
                    return eval('return (' . $value . ');');
                };
                return $func($row['option_value']);
            } catch (\Throwable $e) {
                return false;
            }
        }

        return $row['option_value'];
    }
}
