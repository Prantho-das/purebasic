<?php
// app/Helpers/BusinessSettingHelper.php (Create this file)

if (!function_exists('get_business_setting')) {
    /**
     * Helper to fetch business setting by type.
     * If value is JSON (array), it decodes and returns the array.
     * If simple value (string/int/etc.), returns as-is.
     * Returns null if not found.
     *
     * @param string $type
     * @param mixed $default (optional)
     * @return mixed
     */
    function get_business_setting(string $type, $default = null)
    {
        $setting = \Illuminate\Support\Facades\Cache::remember('business_setting_' . $type, 3600, function () use ($type) {
            $row = \Illuminate\Support\Facades\DB::table('business_settings')
                ->where('type', $type)
                ->first(['value']);

            if (!$row) {
                return null;
            }

            $value = $row->value;

            // Check if it's JSON
            if (is_string($value) && json_decode($value) !== null) {
                return json_decode($value, true); // Return assoc array
            }

            return $value; // Simple value
        });

        return $setting ?? $default;
    }
}