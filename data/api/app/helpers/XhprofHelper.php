<?php

namespace App\helpers;

class XhprofHelper
{
    const LOG_FILE_TYPE = 'xlog';
    const XHPROF_LOG_PATH = '/var/log/xhprof_log';

    /** 
     * @param int $rate Frequency, the program framework has not been loaded yet, env cannot be used at this time
     * @return mixed|null
     */
    static public function beginXhprof($rate = 100)
    {
        if (extension_loaded('xhprof')) {
            xhprof_enable(XHPROF_FLAGS_NO_BUILTINS | XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY);
            return microtime();
        }
        return null;
    }

    /** 
     * @param null $xhprofBeginTime
     * @param string $appName
     * @param int $minTime The minimum value of recorded response events, which will be recorded only after exceeding this value
     */
    static public function endXhprof($xhprofBeginTime = null, $appName = 'test', $minTime = 200)
    {
        if (empty($xhprofBeginTime)) {
            return;
        }

        $xhprofData = xhprof_disable();

        $interval = intval((microtime() - $xhprofBeginTime) * 1000);

        if ($interval > $minTime) {
            self::saveRun($xhprofData, sprintf('%s-%s-%sms', $appName, date('YmdHis'), $interval));
        }
    }

    /** 
     * Save the result to the specified folder
     */
    static private function saveRun($xhprofData, $runId)
    {
        $xhprofData = serialize($xhprofData);

        $file = fopen(sprintf('%s/%s.%s', self::XHPROF_LOG_PATH, $runId, self::LOG_FILE_TYPE), 'w');

        if ($file) {
            fwrite($file, $xhprofData);
            fclose($file);
        } else {
            logger('Could not open' . $runId);
        }

        return $runId;
    }
}
