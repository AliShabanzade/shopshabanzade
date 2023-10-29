<?php

namespace App\Enums;




enum PermissionEnums: string
{

    case ADMIN = "admin";

    case USER_ALL = "user.all";
    case USER_INDEX = "user.index";
    case USER_SHOW = "user.show";
    case USER_STORE = "user.store";
    case USER_UPDATE = "user.update";
    case USER_TOGGLE = "user.toggle";
    case USER_DELETE = "user.delete";
    case USER_RESTORE = "user.restore";










    case POST_ALL = "post.all";
    case POST_INDEX = "post.index";
    case POST_SHOW = "post.show";
    case POST_STORE = "post.store";
    case POST_UPDATE = "post.update";
    case POST_TOGGLE = "post.toggle";
    case POST_DELETE = "post.delete";
    case POST_RESTORE = "post.restore";





    case PRODUCT_MAKE_ALL = "product_make.all";
    case PRODUCT_MAKE_INDEX = "product_make.index";
    case PRODUCT_MAKE_SHOW = "product_make.show";
    case PRODUCT_MAKE_STORE = "product_make.store";
    case PRODUCT_MAKE_UPDATE = "product_make.update";
    case PRODUCT_MAKE_TOGGLE = "product_make.toggle";
    case PRODUCT_MAKE_DELETE = "product_make.delete";
    case PRODUCT_MAKE_RESTORE = "product_make.restore";







}
