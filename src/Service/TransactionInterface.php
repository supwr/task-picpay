<?php

namespace App\Service;

use App\Entity\Transaction;

interface TransactionInterface
{
    public function createTransaction(Transaction $transaction);
}