<?php
/**
 * Created by PhpStorm.
 * User: vietdung
 * Date: 21/02/2019
 * Time: 10:05
 */

namespace Vietdung\Staff\Setup;


use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $conn = $setup->getConnection();
        $tableName = $setup->getTable('staff');
        if (!$conn->isTableExists($tableName)) {
            $table = $conn->newTable($tableName)
                ->addColumn(
                    "id",
                    Table::TYPE_INTEGER,
                    null,
                    [
                        "primary" => true,
                        "identity" => true,
                        "unsigned" => true,
                        "nullable" => false
                    ]
                )->addColumn(
                    "image",
                    Table::TYPE_TEXT,
                    255,
                    [
                        "nullable" => true,
                        "default" => ''
                    ]
                )->addColumn(
                    "status",
                    Table::TYPE_SMALLINT,
                    1,
                    [
                        "nullable" => true,
                        "default" => 0
                    ]
                )
                ->setOption("charset", "utf8");
            $conn->createTable($table);
        }
        $setup->endSetup();
    }
}