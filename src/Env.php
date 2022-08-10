<?php
/*
 * @Description  : 
 * @Author       : 陈志祥
 * @CreateTime   : 2022-08-10 16:31:59
 * @LastEditTime : 2022-08-10 16:39:40
 * @FilePath     : /src/Env.php
 */
class Env
{
    /**
     * 加载配置文件
     * @access public
     * @param string $filePath 配置文件路径  - php7+以上加string
     * @return void - php7+才支持
     */
    public static function loadFile($filePath = '') //:void
    {
        $filePath = ROOT_BASE_PATH . '.env';
        if (!file_exists($filePath)) {
            throw new \Exception('配置文件:' . $filePath . '不存在');
        }
        //返回二位数组
        $env = parse_ini_file($filePath, true);
        // print_r($env);
        foreach ($env as $key => $val) {
            $prefix = strtoupper($key);
            if (is_array($val)) {
                foreach ($val as $k => $v) {
                    $item = $prefix . '_' . strtoupper($k);
                    putenv("$item=$v");
                }
            } else {
                putenv("$prefix=$val");
            }
        }
    }

    /**
     * 获取环境变量值
     * @access public
     * @param string $name 环境变量名（支持二级 . 号分割）
     * @param string $default 默认值
     * @return mixed
     */
    public static function get($name, $default = null)
    {
        $result = getenv(strtoupper(str_replace('.', '_', $name)));
        if (false !== $result) {
            if ('false' === $result) {
                $result = false;
            } elseif ('true' === $result) {
                $result = true;
            }
            return $result;
        }
        return $default;
    }
}
