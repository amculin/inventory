<?php
namespace app\enums;

enum Role: int {
    case SYSTEM = 1;
    case ADMIN = 2;
    case WAREHOUSE = 3;
    case CASHIER = 4;
}
