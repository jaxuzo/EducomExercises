<?php

class ShopModel{

    protected Database $db;
    protected string $last_error;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }
        
    public function getShopItems(): ?array
    {
        $sql = "SELECT * FROM items";
        $result = $this->db->query($sql);
        // Dus of returned de eerste, of wordt null
        return $result;
    }

    public function getItemById(int $id): ?array{
        $sql = "SELECT * FROM items WHERE product_id = ?";
        $result = $this->db->query($sql, [$id]);

        return $result[0] ?? null;
    }


}