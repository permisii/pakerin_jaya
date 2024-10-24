<?php

namespace App\Support\Enums;

enum IntentEnum: string {
    case USER_SEARCH_USERS = 'USER_SEARCH_USERS';
    case ASSIGNMENT_SELECT2_SEARCH_ASSIGNMENTS = 'ASSIGNMENT_SELECT2_SEARCH_ASSIGNMENTS';
    case USER_SELECT2_SEARCH_USERS = 'USER_SELECT2_SEARCH_USERS';
    case PC_SELECT2_SEARCH_PCS = 'PC_SELECT2_SEARCH_PCS';
    case PRINTER_SELECT2_SEARCH_PRINTERS = 'PRINTER_SELECT2_SEARCH_PRINTERS';
}
