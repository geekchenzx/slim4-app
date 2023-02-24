<?php
/*
 * @Description  : 
 * @Author       : 陈志祥
 * @CreateTime   : 2022-08-10 16:31:59
 * @LastEditTime : 2023-02-24 16:07:00
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
        $filePath ='../.env';
        if (!file_exists($filePath)) {
            throw new \Exception('配置文件:' . $filePath . '不存在');
        }

        //返回二位数组
        $env = parse_ini_file($filePath, true);


        foreach ($env as $key => $val) {

            // echo '<pre>';
            // var_dump($val);
            // die;
            $prefix = strtoupper($key);
            $_ENV[strtoupper($prefix)] = array_change_key_case($val);
            // if (is_array($val)) {

            //     // foreach ($val as $k => $v) {
            //     //     // $item = $prefix . '_' . strtoupper($k);
            //     //     // $item =  strtolower($k);
            //     //     //         var_dump($item);
            //     //     // die;
            //     //     // putenv("$item=$v");
            //     //     $_ENV[strtoupper($prefix)] = $v;
            //     // }
            // } else {
            //     // putenv("$prefix=$val");
            //     $_ENV[$prefix] = $val;
            // }
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
        $result = strtoupper(str_replace('.', '_', $name));

        $result = $_ENV[$result]??$default;

        // if (false !== $result) {
        //     if ('false' === $result) {
        //         $result = false;
        //     } elseif ('true' === $result) {
        //         $result = true;
        //     }
        //     return $result;
        // }
        
        return $result ;
    }
}
