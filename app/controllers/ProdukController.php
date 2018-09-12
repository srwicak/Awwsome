<?php

class ProdukController extends \Awwsome\MVC\Controller
{
    public function index()
    {
        echo "<h2>Daftar Produk</h2>";
        $this->loadModel();
        parent::renderView();
        $list = array("maspihong", "mastihang", "masting-bad");
        foreach ($list as $asem) {
            $pro = $asem;
            echo "<div class=\"container\"><a href=\"produk/detil/$pro\">detil $pro</a> | <a href=\"beli/$pro/1\">Beli Satu</a></div>";
        }
    }

    public function detil($merek = null)
    {
        if ($merek != null){

            $harga = rand(40, 50) * 1000;
            echo "<div class=\"container\">
    <table>
        <tr>
            <td>MEREK:</td>
            <td>$merek</td>
        </tr>
        <tr>
            <td>HARGA:</td>
            <td>$harga</td>
        </tr>
    </table>
</div>";
        } else {
            self::index();
        }
    }

    public function beli($merek, $jumlah){
        $harga = rand(40, 50) * 1000;
        echo "<div class=\"container\">
    <table>
        <tr>
            <td>MEREK:</td>
            <td>$merek</td>
        </tr>
        <tr>
            <td>BANYAKNYA:</td>
            <td>$jumlah</td>
        </tr>

        <tr>
            <td>HARGA SATUAN:</td>
            <td>$harga</td>
        </tr>
        <tr>
            <td>TOTAL HARGA:</td>
            <td>$harga * $jumlah</td>
        </tr>
    </table>
</div>";
    }

    public function totalHarga($barang1, $barang2, $barang3)
    {
        $total = $barang1+$barang2+$barang3;
        echo "TOTAL HARGA = " . $total;
    }
}