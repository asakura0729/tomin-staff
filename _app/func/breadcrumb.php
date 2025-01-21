<?php
class appFuncBreadcrumb
{
    public function disp($sitemap, $tmpl)
    {
        foreach ($sitemap as $value) {
            if (isset($value['path'])) {
                $path = $value['path'];
            } else {
                $path = null;
            }
            if (isset($value['title'])) {
                $title = $value['title'];
            } else {
                $title = '';
            }
            include $tmpl;
        }
    }
}
