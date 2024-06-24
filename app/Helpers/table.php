<?php

if (!function_exists('badge')) {
    function badge($type)
    {
        if (in_array($type, ["ادمن فرعي", "أدمن رئيسي"])) {
            return "badge rounded-pill badge-danger";
        }

        if ($type == "فرد") {
            return "badge rounded-pill badge-warning";
        }

        if ($type == "شركة") {
            return "badge rounded-pill badge-info";
        }

        if (in_array($type, ["موظف"])) {
            return "badge rounded-pill badge-success";
        }
    }
}
