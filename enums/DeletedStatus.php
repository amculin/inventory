<?php
namespace app\enums;

enum DeletedStatus: int {
    case IS_NOT_DELETED = 0;
    case IS_DELETED = 1;
}
