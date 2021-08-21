<?php

namespace App\Models\Enum;

class OrderStatus
{
    const STATUS_NEW = 'Новый';
    const STATUS_PROCESSED = 'В процессе';
    const STATUS_TRANSFERRED_TO_SUPPLIER = 'Передан поставщику';
    const STATUS_AT_THE_POST_OFFICE = 'На почте';
    const STATUS_CANCELED = 'Отменен';
    const STATUS_RETURN = 'Возврат';
    const STATUS_DONE = 'Выполнен';
    const STATUS_AWAITING_DISPATCH = 'Ожидает отправки';
    const STATUS_AWAITING_PREPAYMENT = 'Ожидает предоплаты';
    const STATUS_ON_THE_ROAD = 'В дороге';
}
