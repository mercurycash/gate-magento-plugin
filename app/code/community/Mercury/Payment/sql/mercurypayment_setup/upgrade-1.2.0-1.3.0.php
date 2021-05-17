<?php

/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;

$installer->startSetup();

/** @var $adapter Varien_Db_Adapter_Pdo_Mysql */
$adapter = $installer->getConnection();

$tables = [
    'sales_flat_quote_payment',
    'sales_flat_order_payment'
];

foreach ($tables as $model) {
    $table = $installer->getTable($model);

    $installer->getConnection()
        ->addColumn($table, 'mercury_transaction', [
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'length' => 255,
            'nullable' => true,
            'comment' => 'Blockchain Transaction',
        ]);
}

$installer->endSetup ();
