<?php

namespace App\Helper;

use Illuminate\Support\Facades\Storage;

class Helper
{
    protected $encrypt_method = "AES-256-CBC";
    protected $secret_key = "-----BEGIN RSA PRIVATE KEY-----
                            MIIJJgIBAAKCAgBreNIbd2DaTSeqKPqr/ukddODwVM9exDdjIx2OpqS/wbPKRzI7
                            V0o3UHhYwPGrw0Lot00m28oZU5ObRfbMrFEEKoIlX2LAp6FV0BtNVM706UlPzcEj
                            fdmeRlLZlfopdWrm8U/dcRCZ08/7D57BnwkF5MNgbdLy7nDs6hYgwXK77u0CVOxj
                            kN+vJn6FmbQuV33IfoUVNaC/vR8wIH+5yXIWWG2YSglYXxc4vCaAZ+ZBmJuw0up6
                            PDf7EpUhnW18Og5lhzBX6GJ3fxJmtk0zp4qy4ps/S7lWiWDPFXFvuTLZebQ8xmaE
                            pfMV0CLCk9Bjbhe+jBHVQ+cFqmZl8dnbiLY2w5zN59c+gOdJ4RlW4d5si+b2M+aY
                            wJlqWze9kDAJIk6GvwLHG2OKu3/2ZoBfVVphZHDL6LIIFjCl6OYPreBXYTjLlvNY
                            q7RRoBrY1WsSmcyrNxu/cut9Q5g5rQg+vSipB6nOORzhZzqpVB/dsby+Vv9Pzje/
                            tIfnC7TGNXJ+RGp0tWcYybR+BjJkaJ5pzw1pao3GPDH1WCDgc0HHWR41oAgKHDUV
                            pHd2bjwYGnSb6Du8xKzk/nSqy2W6F2ofIvwVzn9+RatidYGcGPs4XD4L75QSOgwi
                            HfM04JRKPxDbxYLJjS5D2Mld2s5WrAMcRRfeeNaA0DZ5b37XmqwzfP798wIDAQAB
                            AoICAGHFP7eXCfhvOod10l5IgAC5RK2/Kgw3i3/YAVq2RajhalO6I3uStMTPozxz
                            AyjUcXlO0JRqXVhfDSi0JIsctHOKzG19clR7660qrrvSTJjH5lcAgxVrt19i8Jpb
                            84Jl/IPuwk5dPtICvPHUywOwT8AZ1phSMReqTfdqGglgk6Ve/iUh5w/JS4WHCpE2
                            PJHwLFEKsL2T1RK51batyiTVm8GyXrmtmQTZNUH7ATfNzc6dK/5YUtIzGGaECEHV
                            ezYJhvFcZGGE2peFddMVQ/SbFfYZa0zQ8eJFBlo+Ur1mCVmJe6vSfo9sfVG50PWd
                            DXZ3QIir2slehbxEwfU6aYxruf+3woshLxzgsmIlGXQIQEg9glccK+aQ2T7QlE92
                            9Q9mwZVSlAAzx6ZdRCwMnAn74LM85WxLJ3ZqgHLN9fGuKfqdZdsz51DYN05dV7JE
                            MtqZS5w8hJIwW4NHiOwPqKxM85iZS3yP36IgZyivnoqQBN4qezrOJ5LDV+BYSWt+
                            pnVn3cEF1AcffWj/fM9Go9HBUoFER4xDaMxWo4Wgl5/g/dCa0rdSwKTnoEIUtgQV
                            KYAD8UUkgm+DwvXTfDekyxvoDobQvRbg5uohwYljRWayywxbITjkJAYUjrNcrE+A
                            YvUH8D5pMOFb/iQVoDBS+I/ug+sIfOORI+FeSMPPXDjRIF8ZAoIBAQCxmavR+NsZ
                            7alc7SdzEXkxdgs/mjkANuOSPKTGIq0NlnK17lrszVfOrFDn0IVAqlXxyoDWODn0
                            vhcNOBcHjEkw7zgwjftdSIEwMdZzAJMx01TLGcah2jd6Ih6ADq7C6eB8lzYL+YBv
                            xAOrwG2VBI8pqV+B6hmW68qZh7utBgcL43Z0Tn5nzhvKxlzH/ncvQKtWLavV2L3O
                            uTNW6Cqn44hhd7H9uhRtvucQ/YOZirHgMU8YD5I4dx/dA7pA4xgOkFBsbOx1KVPh
                            StCb0RNUhwPZbF+5FkWPVnozuefRhIYjw/S8gys8FVx6ikcCMeShZdrOkoqotJqF
                            pCTWtFOvvMc1AoIBAQCa6g7SA05Xjy0TYXqux+7vlVbfR7qx7bGmlkl8/3WLPH1j
                            HoBE7qZ+KASf7L1TXqjk7QqMAzZsMtqkSVbb+fW1RuO7x69LQG5661EXDQgGeViV
                            3mHJiHynHU3CIRzYcNEIVKet/Vt2PIJBoUp/Bh/VeXfyH5/GKxh7bP+Bk0brKCcG
                            jesNSd1K5LHjGuldv08abjFpD9mczg97IDKjKgBbRU9DZPLy2SsWU+vN2x31ZnGm
                            uau7NOd/wwEMfiu9SzmDA9BAIVkI4LH4xVXPoFRmOAfgJ3DkYbCgSnS3aqOsAIq9
                            t/ZW8snwnzOM1sYfy4wQbHOk/LFBxfnf2QJ8S02HAoIBADAb+aBacje22o8SqwIP
                            tK3CVU+4XkKBm+nsRZJqqEgq/g3scHL/OQ8CPLRfFwmqWrex7G6bMo/qwmHRVOO1
                            i8oWszjr7TCayGwexAHJIRZ5MdoGtHj5nNeX0H1N/OdN5YK6j2h1AObFyVzINqcM
                            Yh+eAwI1QRNR8kLesucu38/HoTnmXXWPLpYiX9XJR83kDcW9f3PhT6FlJ9Qd9hge
                            mb4VZ4Dc3FXSRdOjaPe5y294y/0vkqN7GYWMUfLr0YN4cmC8rN0cAd3gn1vmKf9W
                            x6MpKVEBCHzIpzfF31cxOAkONwit25NeEfwb4xpkG5Pg/IHCzo7exZD4IwaKOLU9
                            RRUCggEAAjebYrIdau9nq8FXaiz+ZHt0tNln+Kf4RPQdtSZK3mVNPh/vogzwYRnd
                            hxRyWUEflbc20W4yVzYbHwLVtWxMcf3DwKpI/gC8FBJOJNBQ7xbJh8uZBrNnZVTs
                            Cf1DVm228DGV/M2Fg5m2G45dbJf/2KRWbSa6uLFhNlMHDSm4eCEo/dUGKjiGbE39
                            pcx6zpawYSZ2mpRZfv8MBa0eTGuLecLyMXq+Z29oSHeHBnk+YobG1aYOqS1GqvN1
                            jmI36gurlQ526pQPnCrrIS5h3gjjbFsc8b5exUYIqyKlrQJfuVSAp9p8Mh5jeYgt
                            yrRAPbBCHvIObawYNWLKAsQuXu0M/QKCAQAXJO3/nNtdbcPirvZ66mivF2pr/L7y
                            NGWEJ9DD4HXhDhfx96G36wlELzo8RlSstSCsyRubWJ92tcqNRJIFJf1RTNBn32rx
                            BXX9jUpfwoPVjCToVf+jwO0BPUt5Wxd8Na7ayhUrU9sxUTP2WlglS7tEfzZ1dQH7
                            LSXqd9b6s2f3y0TSmtQik4VO0RpHokIEm/iKQ7cXRG7B1nigw/j8OeyT5S4yle1L
                            pm9L+wqSafldQk6omYOQTQKJDeGNogy7/RqsmKjjDuxgiE/2EANY8KYGsYpvMSJc
                            0YiElv35mv5Bh494/1CqM1F+746nhFI+JVosgZuENRwT6J5ipm6OB7+O
                            -----END RSA PRIVATE KEY-----";
    protected $secret_iv = 'nguyenkhoi_dev';

    public function encrypt($string = '')
    {
        // hash
        $key = hash('sha256', $this->secret_key);
        $iv = substr(hash('sha256', $this->secret_iv), 0, 16);
        $output = openssl_encrypt($string, $this->encrypt_method, $key, 0, $iv);
        return base64_encode($output);
    }

    public function decrypt($string = '')
    {
        // hash
        $key = hash('sha256', $this->secret_key);
        $iv = substr(hash('sha256', $this->secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $this->encrypt_method, $key, 0, $iv);
        return $output;
    }

    public function post_status($status = 0)
    {
        echo $status == 0 ?
            '<span class="badge bg-danger">Không kích hoạt</span>' :
            '<span class="badge bg-success">Kích hoạt</span>';
    }

    public function filter_folder($directory)
    {
        $folders = [];

        $directories = Storage::directories($directory);

        foreach ($directories as $item) {
            $folders[] = basename($item);
        }

        return $folders;
    }

    public function widget($widget = 0)
    {
        echo $widget == 0 ?
            '<span class="badge badge-success">Mặc định</span>' :
            ($widget == 1 ?
                '<span class="badge badge-success">Bên trái</span>' :
                '<span class="badge badge-success">Bên phải</span>');
    }

    public function slider_type($type = 0)
    {
        echo $type == 0 ?
            '<span class="badge bg-danger">Image</span>' :
            '<span class="badge badge-success">Image Text</span>';
    }

    public function price($price, $price_to, $prefix)
    {
        return $price_to !== null && $price !== null ?
            $prefix . $price . ' - ' . $prefix . $price_to :
            ($price_to === null && $price !== null ?
                $prefix . $price :
                "N/A");
    }

    public static function create_short($input, $length = 200)
    {
        if (strlen($input) <= $length)
            return $input;

        $parts = explode(" ", $input);

        while (strlen(implode(" ", $parts)) > $length)
            array_pop($parts);

        return strip_tags(implode(" ", $parts) . "...");
    }

    public function type_menu($type = 0)
    {
        $mesage = '';
        switch ($type) {
            case 2:
                $mesage = '<span class="btn-secondary badge p-1">Post Category</span>';
                break;
            case 1:
                $mesage = '<span class="btn-secondary badge p-1">Product Category</span>';
                break;
            case 0:
                $mesage = '<span class="btn-secondary badge p-1">Link tuỳ chọn</span>';
                break;
        }
        return $mesage;
    }

    public function getMenus($menus, $parent_id = 0)
    {
        $html = '';
        foreach ($menus as $item) {
            if ($item->parent_id === $parent_id) {
                $html .= '<tr>';
                $html .= '<td><input type="checkbox" value="' . $item->id . '" name="check_all[]" class="check"></td>';
                $html .= '<td>' . ($parent_id != 0 ? "-- " : ""). $item->title . '</td>';
                $html .= '<td>' . $this->type_menu($item->type) . '</td>';
                $html .= '<td><input type="number" class="form-control change__selected" readonly name="sort_by_'.$item->id.'" id="" value="' . $item->sort_by . '"></td>';
                $html .= '<td>' . ($item->is_active == 0 ?
                    "<span class=\"badge bg-danger\">Không kích hoạt</span>" :
                    "<span class=\"badge bg-success\">Kích hoạt</span>") . '</td>';
                $html .= '<td>' . $item->created_at . '</td>';
                $html .= '<td class="text-center">';
                $html .= '<a class="btn btn-warning btn-sm" href="' . route('menus.edit', ['id' => $item->id]) . '" data-original-title="Chỉnh sữa">';
                $html .= '<i class="fas fa-user-edit"></i></a>';
                $html .= '<form method="post" class="d-inline" action="' . route('menus.destroy', ['id' => $item->id]) . '">';
                $html .=  csrf_field();
                $html .= '<input type="hidden" name="_method" value="delete">';
                $html .= '<button type="submit" data-toggle="tooltip" data-placement="top" title="" class="btn btn-sm btn-danger" data-original-title="Xoá">';
                $html .= '<i class="fas fa-trash"></i></button>';
                $html .= '</form>';
                $html .= '</td>';
                $html .= '</tr>';
                $html .= $this->getMenus($menus,$item->id);
            }
        }
        return $html;
    }


    public function menu($menus,$parent_id = 0)
    {
        $html = '';
        foreach ($menus as $item)
        {
            if ($item->parent_id === $parent_id)
            {
                $html .= '<li>';
                $html .= '<a class="nav-link" href="'.
                    ($item->type == 0 ?
                        url($item->slug) :
                        ($item->type == 1 ? url('product-category/'.$item->slug) : url('category/'.$item->slug))).'">'.$item->title.'</a>';

                if ($this->hasChild($menus,$item->id))
                {
                    $html .= '<div class="more"><i class="fal fa-chevron-down down__check"></i><i class="fal fa-chevron-up d-none up__check"></i></div>';
                    $html .= '<ul class="sub-menus dropdown-menu list-unstyled">';
                    $html .= $this->menu($menus,$item->id);
                    $html .= '</ul>';
                }

                $html .= '</li>';
            }
        }
        return $html;
    }
    public function hasChild($menus,$parent_id = 0)
    {
        foreach ($menus as $item)
        {
            if ($item->parent_id == $parent_id)
            {
                return true;
            }
        }
        return false;
    }

    public static function type_comment($type = 0)
    {

        return $type == 0 ?
            '<span class="btn-secondary badge p-1">Bài viết</span>' :
            '<span class="btn-secondary badge p-1">Sản phẩm</span>';
    }
    public static function comment_status($type = 0)
    {

        return $type == 0 ?
        '<span class="badge bg-danger">Chờ duyệt</span>' :
        '<span class="badge bg-success">Duyệt</span>';
    }
    public static function admin_status($type = 0)
    {

        return $type == 0 ?
            '<span class="badge bg-danger">Banner</span>' :
            '<span class="badge bg-success">Active</span>';
    }
}
