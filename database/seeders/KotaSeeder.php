<?php

namespace Database\Seeders;

use App\Models\Kota;
use Illuminate\Database\Seeder;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kotas = collect([
            [
                "id" => "1",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kabupaten",
                "nama" => "Aceh Barat",
                "postal_code" => "23681"
            ],
            [
                "id" => "2",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kabupaten",
                "nama" => "Aceh Barat Daya",
                "postal_code" => "23764"
            ],
            [
                "id" => "3",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kabupaten",
                "nama" => "Aceh Besar",
                "postal_code" => "23951"
            ],
            [
                "id" => "4",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kabupaten",
                "nama" => "Aceh Jaya",
                "postal_code" => "23654"
            ],
            [
                "id" => "5",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kabupaten",
                "nama" => "Aceh Selatan",
                "postal_code" => "23719"
            ],
            [
                "id" => "6",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kabupaten",
                "nama" => "Aceh Singkil",
                "postal_code" => "24785"
            ],
            [
                "id" => "7",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kabupaten",
                "nama" => "Aceh Tamiang",
                "postal_code" => "24476"
            ],
            [
                "id" => "8",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kabupaten",
                "nama" => "Aceh Tengah",
                "postal_code" => "24511"
            ],
            [
                "id" => "9",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kabupaten",
                "nama" => "Aceh Tenggara",
                "postal_code" => "24611"
            ],
            [
                "id" => "10",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kabupaten",
                "nama" => "Aceh Timur",
                "postal_code" => "24454"
            ],
            [
                "id" => "11",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kabupaten",
                "nama" => "Aceh Utara",
                "postal_code" => "24382"
            ],
            [
                "id" => "12",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kabupaten",
                "nama" => "Agam",
                "postal_code" => "26411"
            ],
            [
                "id" => "13",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Alor",
                "postal_code" => "85811"
            ],
            [
                "id" => "14",
                "provinsi_id" => "19",
                "province" => "Maluku",
                "type" => "Kota",
                "nama" => "Ambon",
                "postal_code" => "97222"
            ],
            [
                "id" => "15",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Asahan",
                "postal_code" => "21214"
            ],
            [
                "id" => "16",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Asmat",
                "postal_code" => "99777"
            ],
            [
                "id" => "17",
                "provinsi_id" => "1",
                "province" => "Bali",
                "type" => "Kabupaten",
                "nama" => "Badung",
                "postal_code" => "80351"
            ],
            [
                "id" => "18",
                "provinsi_id" => "13",
                "province" => "Kalimantan Selatan",
                "type" => "Kabupaten",
                "nama" => "Balangan",
                "postal_code" => "71611"
            ],
            [
                "id" => "19",
                "provinsi_id" => "15",
                "province" => "Kalimantan Timur",
                "type" => "Kota",
                "nama" => "Balikpapan",
                "postal_code" => "76111"
            ],
            [
                "id" => "20",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kota",
                "nama" => "Banda Aceh",
                "postal_code" => "23238"
            ],
            [
                "id" => "21",
                "provinsi_id" => "18",
                "province" => "Lampung",
                "type" => "Kota",
                "nama" => "Bandar Lampung",
                "postal_code" => "35139"
            ],
            [
                "id" => "22",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kabupaten",
                "nama" => "Bandung",
                "postal_code" => "40311"
            ],
            [
                "id" => "23",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kota",
                "nama" => "Bandung",
                "postal_code" => "40111"
            ],
            [
                "id" => "24",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kabupaten",
                "nama" => "Bandung Barat",
                "postal_code" => "40721"
            ],
            [
                "id" => "25",
                "provinsi_id" => "29",
                "province" => "Sulawesi Tengah",
                "type" => "Kabupaten",
                "nama" => "Banggai",
                "postal_code" => "94711"
            ],
            [
                "id" => "26",
                "provinsi_id" => "29",
                "province" => "Sulawesi Tengah",
                "type" => "Kabupaten",
                "nama" => "Banggai Kepulauan",
                "postal_code" => "94881"
            ],
            [
                "id" => "27",
                "provinsi_id" => "2",
                "province" => "Bangka Belitung",
                "type" => "Kabupaten",
                "nama" => "Bangka",
                "postal_code" => "33212"
            ],
            [
                "id" => "28",
                "provinsi_id" => "2",
                "province" => "Bangka Belitung",
                "type" => "Kabupaten",
                "nama" => "Bangka Barat",
                "postal_code" => "33315"
            ],
            [
                "id" => "29",
                "provinsi_id" => "2",
                "province" => "Bangka Belitung",
                "type" => "Kabupaten",
                "nama" => "Bangka Selatan",
                "postal_code" => "33719"
            ],
            [
                "id" => "30",
                "provinsi_id" => "2",
                "province" => "Bangka Belitung",
                "type" => "Kabupaten",
                "nama" => "Bangka Tengah",
                "postal_code" => "33613"
            ],
            [
                "id" => "31",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Bangkalan",
                "postal_code" => "69118"
            ],
            [
                "id" => "32",
                "provinsi_id" => "1",
                "province" => "Bali",
                "type" => "Kabupaten",
                "nama" => "Bangli",
                "postal_code" => "80619"
            ],
            [
                "id" => "33",
                "provinsi_id" => "13",
                "province" => "Kalimantan Selatan",
                "type" => "Kabupaten",
                "nama" => "Banjar",
                "postal_code" => "70619"
            ],
            [
                "id" => "34",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kota",
                "nama" => "Banjar",
                "postal_code" => "46311"
            ],
            [
                "id" => "35",
                "provinsi_id" => "13",
                "province" => "Kalimantan Selatan",
                "type" => "Kota",
                "nama" => "Banjarbaru",
                "postal_code" => "70712"
            ],
            [
                "id" => "36",
                "provinsi_id" => "13",
                "province" => "Kalimantan Selatan",
                "type" => "Kota",
                "nama" => "Banjarmasin",
                "postal_code" => "70117"
            ],
            [
                "id" => "37",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Banjarnegara",
                "postal_code" => "53419"
            ],
            [
                "id" => "38",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Bantaeng",
                "postal_code" => "92411"
            ],
            [
                "id" => "39",
                "provinsi_id" => "5",
                "province" => "DI Yogyakarta",
                "type" => "Kabupaten",
                "nama" => "Bantul",
                "postal_code" => "55715"
            ],
            [
                "id" => "40",
                "provinsi_id" => "33",
                "province" => "Sumatera Selatan",
                "type" => "Kabupaten",
                "nama" => "Banyuasin",
                "postal_code" => "30911"
            ],
            [
                "id" => "41",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Banyumas",
                "postal_code" => "53114"
            ],
            [
                "id" => "42",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Banyuwangi",
                "postal_code" => "68416"
            ],
            [
                "id" => "43",
                "provinsi_id" => "13",
                "province" => "Kalimantan Selatan",
                "type" => "Kabupaten",
                "nama" => "Barito Kuala",
                "postal_code" => "70511"
            ],
            [
                "id" => "44",
                "provinsi_id" => "14",
                "province" => "Kalimantan Tengah",
                "type" => "Kabupaten",
                "nama" => "Barito Selatan",
                "postal_code" => "73711"
            ],
            [
                "id" => "45",
                "provinsi_id" => "14",
                "province" => "Kalimantan Tengah",
                "type" => "Kabupaten",
                "nama" => "Barito Timur",
                "postal_code" => "73671"
            ],
            [
                "id" => "46",
                "provinsi_id" => "14",
                "province" => "Kalimantan Tengah",
                "type" => "Kabupaten",
                "nama" => "Barito Utara",
                "postal_code" => "73881"
            ],
            [
                "id" => "47",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Barru",
                "postal_code" => "90719"
            ],
            [
                "id" => "48",
                "provinsi_id" => "17",
                "province" => "Kepulauan Riau",
                "type" => "Kota",
                "nama" => "Batam",
                "postal_code" => "29413"
            ],
            [
                "id" => "49",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Batang",
                "postal_code" => "51211"
            ],
            [
                "id" => "50",
                "provinsi_id" => "8",
                "province" => "Jambi",
                "type" => "Kabupaten",
                "nama" => "Batang Hari",
                "postal_code" => "36613"
            ],
            [
                "id" => "51",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kota",
                "nama" => "Batu",
                "postal_code" => "65311"
            ],
            [
                "id" => "52",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Batu Bara",
                "postal_code" => "21655"
            ],
            [
                "id" => "53",
                "provinsi_id" => "30",
                "province" => "Sulawesi Tenggara",
                "type" => "Kota",
                "nama" => "Bau-Bau",
                "postal_code" => "93719"
            ],
            [
                "id" => "54",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kabupaten",
                "nama" => "Bekasi",
                "postal_code" => "17837"
            ],
            [
                "id" => "55",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kota",
                "nama" => "Bekasi",
                "postal_code" => "17121"
            ],
            [
                "id" => "56",
                "provinsi_id" => "2",
                "province" => "Bangka Belitung",
                "type" => "Kabupaten",
                "nama" => "Belitung",
                "postal_code" => "33419"
            ],
            [
                "id" => "57",
                "provinsi_id" => "2",
                "province" => "Bangka Belitung",
                "type" => "Kabupaten",
                "nama" => "Belitung Timur",
                "postal_code" => "33519"
            ],
            [
                "id" => "58",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Belu",
                "postal_code" => "85711"
            ],
            [
                "id" => "59",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kabupaten",
                "nama" => "Bener Meriah",
                "postal_code" => "24581"
            ],
            [
                "id" => "60",
                "provinsi_id" => "26",
                "province" => "Riau",
                "type" => "Kabupaten",
                "nama" => "Bengkalis",
                "postal_code" => "28719"
            ],
            [
                "id" => "61",
                "provinsi_id" => "12",
                "province" => "Kalimantan Barat",
                "type" => "Kabupaten",
                "nama" => "Bengkayang",
                "postal_code" => "79213"
            ],
            [
                "id" => "62",
                "provinsi_id" => "4",
                "province" => "Bengkulu",
                "type" => "Kota",
                "nama" => "Bengkulu",
                "postal_code" => "38229"
            ],
            [
                "id" => "63",
                "provinsi_id" => "4",
                "province" => "Bengkulu",
                "type" => "Kabupaten",
                "nama" => "Bengkulu Selatan",
                "postal_code" => "38519"
            ],
            [
                "id" => "64",
                "provinsi_id" => "4",
                "province" => "Bengkulu",
                "type" => "Kabupaten",
                "nama" => "Bengkulu Tengah",
                "postal_code" => "38319"
            ],
            [
                "id" => "65",
                "provinsi_id" => "4",
                "province" => "Bengkulu",
                "type" => "Kabupaten",
                "nama" => "Bengkulu Utara",
                "postal_code" => "38619"
            ],
            [
                "id" => "66",
                "provinsi_id" => "15",
                "province" => "Kalimantan Timur",
                "type" => "Kabupaten",
                "nama" => "Berau",
                "postal_code" => "77311"
            ],
            [
                "id" => "67",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Biak Numfor",
                "postal_code" => "98119"
            ],
            [
                "id" => "68",
                "provinsi_id" => "22",
                "province" => "Nusa Tenggara Barat (NTB)",
                "type" => "Kabupaten",
                "nama" => "Bima",
                "postal_code" => "84171"
            ],
            [
                "id" => "69",
                "provinsi_id" => "22",
                "province" => "Nusa Tenggara Barat (NTB)",
                "type" => "Kota",
                "nama" => "Bima",
                "postal_code" => "84139"
            ],
            [
                "id" => "70",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kota",
                "nama" => "Binjai",
                "postal_code" => "20712"
            ],
            [
                "id" => "71",
                "provinsi_id" => "17",
                "province" => "Kepulauan Riau",
                "type" => "Kabupaten",
                "nama" => "Bintan",
                "postal_code" => "29135"
            ],
            [
                "id" => "72",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kabupaten",
                "nama" => "Bireuen",
                "postal_code" => "24219"
            ],
            [
                "id" => "73",
                "provinsi_id" => "31",
                "province" => "Sulawesi Utara",
                "type" => "Kota",
                "nama" => "Bitung",
                "postal_code" => "95512"
            ],
            [
                "id" => "74",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Blitar",
                "postal_code" => "66171"
            ],
            [
                "id" => "75",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kota",
                "nama" => "Blitar",
                "postal_code" => "66124"
            ],
            [
                "id" => "76",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Blora",
                "postal_code" => "58219"
            ],
            [
                "id" => "77",
                "provinsi_id" => "7",
                "province" => "Gorontalo",
                "type" => "Kabupaten",
                "nama" => "Boalemo",
                "postal_code" => "96319"
            ],
            [
                "id" => "78",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kabupaten",
                "nama" => "Bogor",
                "postal_code" => "16911"
            ],
            [
                "id" => "79",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kota",
                "nama" => "Bogor",
                "postal_code" => "16119"
            ],
            [
                "id" => "80",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Bojonegoro",
                "postal_code" => "62119"
            ],
            [
                "id" => "81",
                "provinsi_id" => "31",
                "province" => "Sulawesi Utara",
                "type" => "Kabupaten",
                "nama" => "Bolaang Mongondow (Bolmong)",
                "postal_code" => "95755"
            ],
            [
                "id" => "82",
                "provinsi_id" => "31",
                "province" => "Sulawesi Utara",
                "type" => "Kabupaten",
                "nama" => "Bolaang Mongondow Selatan",
                "postal_code" => "95774"
            ],
            [
                "id" => "83",
                "provinsi_id" => "31",
                "province" => "Sulawesi Utara",
                "type" => "Kabupaten",
                "nama" => "Bolaang Mongondow Timur",
                "postal_code" => "95783"
            ],
            [
                "id" => "84",
                "provinsi_id" => "31",
                "province" => "Sulawesi Utara",
                "type" => "Kabupaten",
                "nama" => "Bolaang Mongondow Utara",
                "postal_code" => "95765"
            ],
            [
                "id" => "85",
                "provinsi_id" => "30",
                "province" => "Sulawesi Tenggara",
                "type" => "Kabupaten",
                "nama" => "Bombana",
                "postal_code" => "93771"
            ],
            [
                "id" => "86",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Bondowoso",
                "postal_code" => "68219"
            ],
            [
                "id" => "87",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Bone",
                "postal_code" => "92713"
            ],
            [
                "id" => "88",
                "provinsi_id" => "7",
                "province" => "Gorontalo",
                "type" => "Kabupaten",
                "nama" => "Bone Bolango",
                "postal_code" => "96511"
            ],
            [
                "id" => "89",
                "provinsi_id" => "15",
                "province" => "Kalimantan Timur",
                "type" => "Kota",
                "nama" => "Bontang",
                "postal_code" => "75313"
            ],
            [
                "id" => "90",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Boven Digoel",
                "postal_code" => "99662"
            ],
            [
                "id" => "91",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Boyolali",
                "postal_code" => "57312"
            ],
            [
                "id" => "92",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Brebes",
                "postal_code" => "52212"
            ],
            [
                "id" => "93",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kota",
                "nama" => "Bukittinggi",
                "postal_code" => "26115"
            ],
            [
                "id" => "94",
                "provinsi_id" => "1",
                "province" => "Bali",
                "type" => "Kabupaten",
                "nama" => "Buleleng",
                "postal_code" => "81111"
            ],
            [
                "id" => "95",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Bulukumba",
                "postal_code" => "92511"
            ],
            [
                "id" => "96",
                "provinsi_id" => "16",
                "province" => "Kalimantan Utara",
                "type" => "Kabupaten",
                "nama" => "Bulungan (Bulongan)",
                "postal_code" => "77211"
            ],
            [
                "id" => "97",
                "provinsi_id" => "8",
                "province" => "Jambi",
                "type" => "Kabupaten",
                "nama" => "Bungo",
                "postal_code" => "37216"
            ],
            [
                "id" => "98",
                "provinsi_id" => "29",
                "province" => "Sulawesi Tengah",
                "type" => "Kabupaten",
                "nama" => "Buol",
                "postal_code" => "94564"
            ],
            [
                "id" => "99",
                "provinsi_id" => "19",
                "province" => "Maluku",
                "type" => "Kabupaten",
                "nama" => "Buru",
                "postal_code" => "97371"
            ],
            [
                "id" => "100",
                "provinsi_id" => "19",
                "province" => "Maluku",
                "type" => "Kabupaten",
                "nama" => "Buru Selatan",
                "postal_code" => "97351"
            ],
            [
                "id" => "101",
                "provinsi_id" => "30",
                "province" => "Sulawesi Tenggara",
                "type" => "Kabupaten",
                "nama" => "Buton",
                "postal_code" => "93754"
            ],
            [
                "id" => "102",
                "provinsi_id" => "30",
                "province" => "Sulawesi Tenggara",
                "type" => "Kabupaten",
                "nama" => "Buton Utara",
                "postal_code" => "93745"
            ],
            [
                "id" => "103",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kabupaten",
                "nama" => "Ciamis",
                "postal_code" => "46211"
            ],
            [
                "id" => "104",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kabupaten",
                "nama" => "Cianjur",
                "postal_code" => "43217"
            ],
            [
                "id" => "105",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Cilacap",
                "postal_code" => "53211"
            ],
            [
                "id" => "106",
                "provinsi_id" => "3",
                "province" => "Banten",
                "type" => "Kota",
                "nama" => "Cilegon",
                "postal_code" => "42417"
            ],
            [
                "id" => "107",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kota",
                "nama" => "Cimahi",
                "postal_code" => "40512"
            ],
            [
                "id" => "108",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kabupaten",
                "nama" => "Cirebon",
                "postal_code" => "45611"
            ],
            [
                "id" => "109",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kota",
                "nama" => "Cirebon",
                "postal_code" => "45116"
            ],
            [
                "id" => "110",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Dairi",
                "postal_code" => "22211"
            ],
            [
                "id" => "111",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Deiyai (Deliyai)",
                "postal_code" => "98784"
            ],
            [
                "id" => "112",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Deli Serdang",
                "postal_code" => "20511"
            ],
            [
                "id" => "113",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Demak",
                "postal_code" => "59519"
            ],
            [
                "id" => "114",
                "provinsi_id" => "1",
                "province" => "Bali",
                "type" => "Kota",
                "nama" => "Denpasar",
                "postal_code" => "80227"
            ],
            [
                "id" => "115",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kota",
                "nama" => "Depok",
                "postal_code" => "16416"
            ],
            [
                "id" => "116",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kabupaten",
                "nama" => "Dharmasraya",
                "postal_code" => "27612"
            ],
            [
                "id" => "117",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Dogiyai",
                "postal_code" => "98866"
            ],
            [
                "id" => "118",
                "provinsi_id" => "22",
                "province" => "Nusa Tenggara Barat (NTB)",
                "type" => "Kabupaten",
                "nama" => "Dompu",
                "postal_code" => "84217"
            ],
            [
                "id" => "119",
                "provinsi_id" => "29",
                "province" => "Sulawesi Tengah",
                "type" => "Kabupaten",
                "nama" => "Donggala",
                "postal_code" => "94341"
            ],
            [
                "id" => "120",
                "provinsi_id" => "26",
                "province" => "Riau",
                "type" => "Kota",
                "nama" => "Dumai",
                "postal_code" => "28811"
            ],
            [
                "id" => "121",
                "provinsi_id" => "33",
                "province" => "Sumatera Selatan",
                "type" => "Kabupaten",
                "nama" => "Empat Lawang",
                "postal_code" => "31811"
            ],
            [
                "id" => "122",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Ende",
                "postal_code" => "86351"
            ],
            [
                "id" => "123",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Enrekang",
                "postal_code" => "91719"
            ],
            [
                "id" => "124",
                "provinsi_id" => "25",
                "province" => "Papua Barat",
                "type" => "Kabupaten",
                "nama" => "Fakfak",
                "postal_code" => "98651"
            ],
            [
                "id" => "125",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Flores Timur",
                "postal_code" => "86213"
            ],
            [
                "id" => "126",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kabupaten",
                "nama" => "Garut",
                "postal_code" => "44126"
            ],
            [
                "id" => "127",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kabupaten",
                "nama" => "Gayo Lues",
                "postal_code" => "24653"
            ],
            [
                "id" => "128",
                "provinsi_id" => "1",
                "province" => "Bali",
                "type" => "Kabupaten",
                "nama" => "Gianyar",
                "postal_code" => "80519"
            ],
            [
                "id" => "129",
                "provinsi_id" => "7",
                "province" => "Gorontalo",
                "type" => "Kabupaten",
                "nama" => "Gorontalo",
                "postal_code" => "96218"
            ],
            [
                "id" => "130",
                "provinsi_id" => "7",
                "province" => "Gorontalo",
                "type" => "Kota",
                "nama" => "Gorontalo",
                "postal_code" => "96115"
            ],
            [
                "id" => "131",
                "provinsi_id" => "7",
                "province" => "Gorontalo",
                "type" => "Kabupaten",
                "nama" => "Gorontalo Utara",
                "postal_code" => "96611"
            ],
            [
                "id" => "132",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Gowa",
                "postal_code" => "92111"
            ],
            [
                "id" => "133",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Gresik",
                "postal_code" => "61115"
            ],
            [
                "id" => "134",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Grobogan",
                "postal_code" => "58111"
            ],
            [
                "id" => "135",
                "provinsi_id" => "5",
                "province" => "DI Yogyakarta",
                "type" => "Kabupaten",
                "nama" => "Gunung Kidul",
                "postal_code" => "55812"
            ],
            [
                "id" => "136",
                "provinsi_id" => "14",
                "province" => "Kalimantan Tengah",
                "type" => "Kabupaten",
                "nama" => "Gunung Mas",
                "postal_code" => "74511"
            ],
            [
                "id" => "137",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kota",
                "nama" => "Gunungsitoli",
                "postal_code" => "22813"
            ],
            [
                "id" => "138",
                "provinsi_id" => "20",
                "province" => "Maluku Utara",
                "type" => "Kabupaten",
                "nama" => "Halmahera Barat",
                "postal_code" => "97757"
            ],
            [
                "id" => "139",
                "provinsi_id" => "20",
                "province" => "Maluku Utara",
                "type" => "Kabupaten",
                "nama" => "Halmahera Selatan",
                "postal_code" => "97911"
            ],
            [
                "id" => "140",
                "provinsi_id" => "20",
                "province" => "Maluku Utara",
                "type" => "Kabupaten",
                "nama" => "Halmahera Tengah",
                "postal_code" => "97853"
            ],
            [
                "id" => "141",
                "provinsi_id" => "20",
                "province" => "Maluku Utara",
                "type" => "Kabupaten",
                "nama" => "Halmahera Timur",
                "postal_code" => "97862"
            ],
            [
                "id" => "142",
                "provinsi_id" => "20",
                "province" => "Maluku Utara",
                "type" => "Kabupaten",
                "nama" => "Halmahera Utara",
                "postal_code" => "97762"
            ],
            [
                "id" => "143",
                "provinsi_id" => "13",
                "province" => "Kalimantan Selatan",
                "type" => "Kabupaten",
                "nama" => "Hulu Sungai Selatan",
                "postal_code" => "71212"
            ],
            [
                "id" => "144",
                "provinsi_id" => "13",
                "province" => "Kalimantan Selatan",
                "type" => "Kabupaten",
                "nama" => "Hulu Sungai Tengah",
                "postal_code" => "71313"
            ],
            [
                "id" => "145",
                "provinsi_id" => "13",
                "province" => "Kalimantan Selatan",
                "type" => "Kabupaten",
                "nama" => "Hulu Sungai Utara",
                "postal_code" => "71419"
            ],
            [
                "id" => "146",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Humbang Hasundutan",
                "postal_code" => "22457"
            ],
            [
                "id" => "147",
                "provinsi_id" => "26",
                "province" => "Riau",
                "type" => "Kabupaten",
                "nama" => "Indragiri Hilir",
                "postal_code" => "29212"
            ],
            [
                "id" => "148",
                "provinsi_id" => "26",
                "province" => "Riau",
                "type" => "Kabupaten",
                "nama" => "Indragiri Hulu",
                "postal_code" => "29319"
            ],
            [
                "id" => "149",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kabupaten",
                "nama" => "Indramayu",
                "postal_code" => "45214"
            ],
            [
                "id" => "150",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Intan Jaya",
                "postal_code" => "98771"
            ],
            [
                "id" => "151",
                "provinsi_id" => "6",
                "province" => "DKI Jakarta",
                "type" => "Kota",
                "nama" => "Jakarta Barat",
                "postal_code" => "11220"
            ],
            [
                "id" => "152",
                "provinsi_id" => "6",
                "province" => "DKI Jakarta",
                "type" => "Kota",
                "nama" => "Jakarta Pusat",
                "postal_code" => "10540"
            ],
            [
                "id" => "153",
                "provinsi_id" => "6",
                "province" => "DKI Jakarta",
                "type" => "Kota",
                "nama" => "Jakarta Selatan",
                "postal_code" => "12230"
            ],
            [
                "id" => "154",
                "provinsi_id" => "6",
                "province" => "DKI Jakarta",
                "type" => "Kota",
                "nama" => "Jakarta Timur",
                "postal_code" => "13330"
            ],
            [
                "id" => "155",
                "provinsi_id" => "6",
                "province" => "DKI Jakarta",
                "type" => "Kota",
                "nama" => "Jakarta Utara",
                "postal_code" => "14140"
            ],
            [
                "id" => "156",
                "provinsi_id" => "8",
                "province" => "Jambi",
                "type" => "Kota",
                "nama" => "Jambi",
                "postal_code" => "36111"
            ],
            [
                "id" => "157",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Jayapura",
                "postal_code" => "99352"
            ],
            [
                "id" => "158",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kota",
                "nama" => "Jayapura",
                "postal_code" => "99114"
            ],
            [
                "id" => "159",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Jayawijaya",
                "postal_code" => "99511"
            ],
            [
                "id" => "160",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Jember",
                "postal_code" => "68113"
            ],
            [
                "id" => "161",
                "provinsi_id" => "1",
                "province" => "Bali",
                "type" => "Kabupaten",
                "nama" => "Jembrana",
                "postal_code" => "82251"
            ],
            [
                "id" => "162",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Jeneponto",
                "postal_code" => "92319"
            ],
            [
                "id" => "163",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Jepara",
                "postal_code" => "59419"
            ],
            [
                "id" => "164",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Jombang",
                "postal_code" => "61415"
            ],
            [
                "id" => "165",
                "provinsi_id" => "25",
                "province" => "Papua Barat",
                "type" => "Kabupaten",
                "nama" => "Kaimana",
                "postal_code" => "98671"
            ],
            [
                "id" => "166",
                "provinsi_id" => "26",
                "province" => "Riau",
                "type" => "Kabupaten",
                "nama" => "Kampar",
                "postal_code" => "28411"
            ],
            [
                "id" => "167",
                "provinsi_id" => "14",
                "province" => "Kalimantan Tengah",
                "type" => "Kabupaten",
                "nama" => "Kapuas",
                "postal_code" => "73583"
            ],
            [
                "id" => "168",
                "provinsi_id" => "12",
                "province" => "Kalimantan Barat",
                "type" => "Kabupaten",
                "nama" => "Kapuas Hulu",
                "postal_code" => "78719"
            ],
            [
                "id" => "169",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Karanganyar",
                "postal_code" => "57718"
            ],
            [
                "id" => "170",
                "provinsi_id" => "1",
                "province" => "Bali",
                "type" => "Kabupaten",
                "nama" => "Karangasem",
                "postal_code" => "80819"
            ],
            [
                "id" => "171",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kabupaten",
                "nama" => "Karawang",
                "postal_code" => "41311"
            ],
            [
                "id" => "172",
                "provinsi_id" => "17",
                "province" => "Kepulauan Riau",
                "type" => "Kabupaten",
                "nama" => "Karimun",
                "postal_code" => "29611"
            ],
            [
                "id" => "173",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Karo",
                "postal_code" => "22119"
            ],
            [
                "id" => "174",
                "provinsi_id" => "14",
                "province" => "Kalimantan Tengah",
                "type" => "Kabupaten",
                "nama" => "Katingan",
                "postal_code" => "74411"
            ],
            [
                "id" => "175",
                "provinsi_id" => "4",
                "province" => "Bengkulu",
                "type" => "Kabupaten",
                "nama" => "Kaur",
                "postal_code" => "38911"
            ],
            [
                "id" => "176",
                "provinsi_id" => "12",
                "province" => "Kalimantan Barat",
                "type" => "Kabupaten",
                "nama" => "Kayong Utara",
                "postal_code" => "78852"
            ],
            [
                "id" => "177",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Kebumen",
                "postal_code" => "54319"
            ],
            [
                "id" => "178",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Kediri",
                "postal_code" => "64184"
            ],
            [
                "id" => "179",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kota",
                "nama" => "Kediri",
                "postal_code" => "64125"
            ],
            [
                "id" => "180",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Keerom",
                "postal_code" => "99461"
            ],
            [
                "id" => "181",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Kendal",
                "postal_code" => "51314"
            ],
            [
                "id" => "182",
                "provinsi_id" => "30",
                "province" => "Sulawesi Tenggara",
                "type" => "Kota",
                "nama" => "Kendari",
                "postal_code" => "93126"
            ],
            [
                "id" => "183",
                "provinsi_id" => "4",
                "province" => "Bengkulu",
                "type" => "Kabupaten",
                "nama" => "Kepahiang",
                "postal_code" => "39319"
            ],
            [
                "id" => "184",
                "provinsi_id" => "17",
                "province" => "Kepulauan Riau",
                "type" => "Kabupaten",
                "nama" => "Kepulauan Anambas",
                "postal_code" => "29991"
            ],
            [
                "id" => "185",
                "provinsi_id" => "19",
                "province" => "Maluku",
                "type" => "Kabupaten",
                "nama" => "Kepulauan Aru",
                "postal_code" => "97681"
            ],
            [
                "id" => "186",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kabupaten",
                "nama" => "Kepulauan Mentawai",
                "postal_code" => "25771"
            ],
            [
                "id" => "187",
                "provinsi_id" => "26",
                "province" => "Riau",
                "type" => "Kabupaten",
                "nama" => "Kepulauan Meranti",
                "postal_code" => "28791"
            ],
            [
                "id" => "188",
                "provinsi_id" => "31",
                "province" => "Sulawesi Utara",
                "type" => "Kabupaten",
                "nama" => "Kepulauan Sangihe",
                "postal_code" => "95819"
            ],
            [
                "id" => "189",
                "provinsi_id" => "6",
                "province" => "DKI Jakarta",
                "type" => "Kabupaten",
                "nama" => "Kepulauan Seribu",
                "postal_code" => "14550"
            ],
            [
                "id" => "190",
                "provinsi_id" => "31",
                "province" => "Sulawesi Utara",
                "type" => "Kabupaten",
                "nama" => "Kepulauan Siau Tagulandang Biaro (Sitaro)",
                "postal_code" => "95862"
            ],
            [
                "id" => "191",
                "provinsi_id" => "20",
                "province" => "Maluku Utara",
                "type" => "Kabupaten",
                "nama" => "Kepulauan Sula",
                "postal_code" => "97995"
            ],
            [
                "id" => "192",
                "provinsi_id" => "31",
                "province" => "Sulawesi Utara",
                "type" => "Kabupaten",
                "nama" => "Kepulauan Talaud",
                "postal_code" => "95885"
            ],
            [
                "id" => "193",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Kepulauan Yapen (Yapen Waropen)",
                "postal_code" => "98211"
            ],
            [
                "id" => "194",
                "provinsi_id" => "8",
                "province" => "Jambi",
                "type" => "Kabupaten",
                "nama" => "Kerinci",
                "postal_code" => "37167"
            ],
            [
                "id" => "195",
                "provinsi_id" => "12",
                "province" => "Kalimantan Barat",
                "type" => "Kabupaten",
                "nama" => "Ketapang",
                "postal_code" => "78874"
            ],
            [
                "id" => "196",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Klaten",
                "postal_code" => "57411"
            ],
            [
                "id" => "197",
                "provinsi_id" => "1",
                "province" => "Bali",
                "type" => "Kabupaten",
                "nama" => "Klungkung",
                "postal_code" => "80719"
            ],
            [
                "id" => "198",
                "provinsi_id" => "30",
                "province" => "Sulawesi Tenggara",
                "type" => "Kabupaten",
                "nama" => "Kolaka",
                "postal_code" => "93511"
            ],
            [
                "id" => "199",
                "provinsi_id" => "30",
                "province" => "Sulawesi Tenggara",
                "type" => "Kabupaten",
                "nama" => "Kolaka Utara",
                "postal_code" => "93911"
            ],
            [
                "id" => "200",
                "provinsi_id" => "30",
                "province" => "Sulawesi Tenggara",
                "type" => "Kabupaten",
                "nama" => "Konawe",
                "postal_code" => "93411"
            ],
            [
                "id" => "201",
                "provinsi_id" => "30",
                "province" => "Sulawesi Tenggara",
                "type" => "Kabupaten",
                "nama" => "Konawe Selatan",
                "postal_code" => "93811"
            ],
            [
                "id" => "202",
                "provinsi_id" => "30",
                "province" => "Sulawesi Tenggara",
                "type" => "Kabupaten",
                "nama" => "Konawe Utara",
                "postal_code" => "93311"
            ],
            [
                "id" => "203",
                "provinsi_id" => "13",
                "province" => "Kalimantan Selatan",
                "type" => "Kabupaten",
                "nama" => "Kotabaru",
                "postal_code" => "72119"
            ],
            [
                "id" => "204",
                "provinsi_id" => "31",
                "province" => "Sulawesi Utara",
                "type" => "Kota",
                "nama" => "Kotamobagu",
                "postal_code" => "95711"
            ],
            [
                "id" => "205",
                "provinsi_id" => "14",
                "province" => "Kalimantan Tengah",
                "type" => "Kabupaten",
                "nama" => "Kotawaringin Barat",
                "postal_code" => "74119"
            ],
            [
                "id" => "206",
                "provinsi_id" => "14",
                "province" => "Kalimantan Tengah",
                "type" => "Kabupaten",
                "nama" => "Kotawaringin Timur",
                "postal_code" => "74364"
            ],
            [
                "id" => "207",
                "provinsi_id" => "26",
                "province" => "Riau",
                "type" => "Kabupaten",
                "nama" => "Kuantan Singingi",
                "postal_code" => "29519"
            ],
            [
                "id" => "208",
                "provinsi_id" => "12",
                "province" => "Kalimantan Barat",
                "type" => "Kabupaten",
                "nama" => "Kubu Raya",
                "postal_code" => "78311"
            ],
            [
                "id" => "209",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Kudus",
                "postal_code" => "59311"
            ],
            [
                "id" => "210",
                "provinsi_id" => "5",
                "province" => "DI Yogyakarta",
                "type" => "Kabupaten",
                "nama" => "Kulon Progo",
                "postal_code" => "55611"
            ],
            [
                "id" => "211",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kabupaten",
                "nama" => "Kuningan",
                "postal_code" => "45511"
            ],
            [
                "id" => "212",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Kupang",
                "postal_code" => "85362"
            ],
            [
                "id" => "213",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kota",
                "nama" => "Kupang",
                "postal_code" => "85119"
            ],
            [
                "id" => "214",
                "provinsi_id" => "15",
                "province" => "Kalimantan Timur",
                "type" => "Kabupaten",
                "nama" => "Kutai Barat",
                "postal_code" => "75711"
            ],
            [
                "id" => "215",
                "provinsi_id" => "15",
                "province" => "Kalimantan Timur",
                "type" => "Kabupaten",
                "nama" => "Kutai Kartanegara",
                "postal_code" => "75511"
            ],
            [
                "id" => "216",
                "provinsi_id" => "15",
                "province" => "Kalimantan Timur",
                "type" => "Kabupaten",
                "nama" => "Kutai Timur",
                "postal_code" => "75611"
            ],
            [
                "id" => "217",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Labuhan Batu",
                "postal_code" => "21412"
            ],
            [
                "id" => "218",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Labuhan Batu Selatan",
                "postal_code" => "21511"
            ],
            [
                "id" => "219",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Labuhan Batu Utara",
                "postal_code" => "21711"
            ],
            [
                "id" => "220",
                "provinsi_id" => "33",
                "province" => "Sumatera Selatan",
                "type" => "Kabupaten",
                "nama" => "Lahat",
                "postal_code" => "31419"
            ],
            [
                "id" => "221",
                "provinsi_id" => "14",
                "province" => "Kalimantan Tengah",
                "type" => "Kabupaten",
                "nama" => "Lamandau",
                "postal_code" => "74611"
            ],
            [
                "id" => "222",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Lamongan",
                "postal_code" => "64125"
            ],
            [
                "id" => "223",
                "provinsi_id" => "18",
                "province" => "Lampung",
                "type" => "Kabupaten",
                "nama" => "Lampung Barat",
                "postal_code" => "34814"
            ],
            [
                "id" => "224",
                "provinsi_id" => "18",
                "province" => "Lampung",
                "type" => "Kabupaten",
                "nama" => "Lampung Selatan",
                "postal_code" => "35511"
            ],
            [
                "id" => "225",
                "provinsi_id" => "18",
                "province" => "Lampung",
                "type" => "Kabupaten",
                "nama" => "Lampung Tengah",
                "postal_code" => "34212"
            ],
            [
                "id" => "226",
                "provinsi_id" => "18",
                "province" => "Lampung",
                "type" => "Kabupaten",
                "nama" => "Lampung Timur",
                "postal_code" => "34319"
            ],
            [
                "id" => "227",
                "provinsi_id" => "18",
                "province" => "Lampung",
                "type" => "Kabupaten",
                "nama" => "Lampung Utara",
                "postal_code" => "34516"
            ],
            [
                "id" => "228",
                "provinsi_id" => "12",
                "province" => "Kalimantan Barat",
                "type" => "Kabupaten",
                "nama" => "Landak",
                "postal_code" => "78319"
            ],
            [
                "id" => "229",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Langkat",
                "postal_code" => "20811"
            ],
            [
                "id" => "230",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kota",
                "nama" => "Langsa",
                "postal_code" => "24412"
            ],
            [
                "id" => "231",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Lanny Jaya",
                "postal_code" => "99531"
            ],
            [
                "id" => "232",
                "provinsi_id" => "3",
                "province" => "Banten",
                "type" => "Kabupaten",
                "nama" => "Lebak",
                "postal_code" => "42319"
            ],
            [
                "id" => "233",
                "provinsi_id" => "4",
                "province" => "Bengkulu",
                "type" => "Kabupaten",
                "nama" => "Lebong",
                "postal_code" => "39264"
            ],
            [
                "id" => "234",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Lembata",
                "postal_code" => "86611"
            ],
            [
                "id" => "235",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kota",
                "nama" => "Lhokseumawe",
                "postal_code" => "24352"
            ],
            [
                "id" => "236",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kabupaten",
                "nama" => "Lima Puluh Koto/Kota",
                "postal_code" => "26671"
            ],
            [
                "id" => "237",
                "provinsi_id" => "17",
                "province" => "Kepulauan Riau",
                "type" => "Kabupaten",
                "nama" => "Lingga",
                "postal_code" => "29811"
            ],
            [
                "id" => "238",
                "provinsi_id" => "22",
                "province" => "Nusa Tenggara Barat (NTB)",
                "type" => "Kabupaten",
                "nama" => "Lombok Barat",
                "postal_code" => "83311"
            ],
            [
                "id" => "239",
                "provinsi_id" => "22",
                "province" => "Nusa Tenggara Barat (NTB)",
                "type" => "Kabupaten",
                "nama" => "Lombok Tengah",
                "postal_code" => "83511"
            ],
            [
                "id" => "240",
                "provinsi_id" => "22",
                "province" => "Nusa Tenggara Barat (NTB)",
                "type" => "Kabupaten",
                "nama" => "Lombok Timur",
                "postal_code" => "83612"
            ],
            [
                "id" => "241",
                "provinsi_id" => "22",
                "province" => "Nusa Tenggara Barat (NTB)",
                "type" => "Kabupaten",
                "nama" => "Lombok Utara",
                "postal_code" => "83711"
            ],
            [
                "id" => "242",
                "provinsi_id" => "33",
                "province" => "Sumatera Selatan",
                "type" => "Kota",
                "nama" => "Lubuk Linggau",
                "postal_code" => "31614"
            ],
            [
                "id" => "243",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Lumajang",
                "postal_code" => "67319"
            ],
            [
                "id" => "244",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Luwu",
                "postal_code" => "91994"
            ],
            [
                "id" => "245",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Luwu Timur",
                "postal_code" => "92981"
            ],
            [
                "id" => "246",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Luwu Utara",
                "postal_code" => "92911"
            ],
            [
                "id" => "247",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Madiun",
                "postal_code" => "63153"
            ],
            [
                "id" => "248",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kota",
                "nama" => "Madiun",
                "postal_code" => "63122"
            ],
            [
                "id" => "249",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Magelang",
                "postal_code" => "56519"
            ],
            [
                "id" => "250",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kota",
                "nama" => "Magelang",
                "postal_code" => "56133"
            ],
            [
                "id" => "251",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Magetan",
                "postal_code" => "63314"
            ],
            [
                "id" => "252",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kabupaten",
                "nama" => "Majalengka",
                "postal_code" => "45412"
            ],
            [
                "id" => "253",
                "provinsi_id" => "27",
                "province" => "Sulawesi Barat",
                "type" => "Kabupaten",
                "nama" => "Majene",
                "postal_code" => "91411"
            ],
            [
                "id" => "254",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kota",
                "nama" => "Makassar",
                "postal_code" => "90111"
            ],
            [
                "id" => "255",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Malang",
                "postal_code" => "65163"
            ],
            [
                "id" => "256",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kota",
                "nama" => "Malang",
                "postal_code" => "65112"
            ],
            [
                "id" => "257",
                "provinsi_id" => "16",
                "province" => "Kalimantan Utara",
                "type" => "Kabupaten",
                "nama" => "Malinau",
                "postal_code" => "77511"
            ],
            [
                "id" => "258",
                "provinsi_id" => "19",
                "province" => "Maluku",
                "type" => "Kabupaten",
                "nama" => "Maluku Barat Daya",
                "postal_code" => "97451"
            ],
            [
                "id" => "259",
                "provinsi_id" => "19",
                "province" => "Maluku",
                "type" => "Kabupaten",
                "nama" => "Maluku Tengah",
                "postal_code" => "97513"
            ],
            [
                "id" => "260",
                "provinsi_id" => "19",
                "province" => "Maluku",
                "type" => "Kabupaten",
                "nama" => "Maluku Tenggara",
                "postal_code" => "97651"
            ],
            [
                "id" => "261",
                "provinsi_id" => "19",
                "province" => "Maluku",
                "type" => "Kabupaten",
                "nama" => "Maluku Tenggara Barat",
                "postal_code" => "97465"
            ],
            [
                "id" => "262",
                "provinsi_id" => "27",
                "province" => "Sulawesi Barat",
                "type" => "Kabupaten",
                "nama" => "Mamasa",
                "postal_code" => "91362"
            ],
            [
                "id" => "263",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Mamberamo Raya",
                "postal_code" => "99381"
            ],
            [
                "id" => "264",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Mamberamo Tengah",
                "postal_code" => "99553"
            ],
            [
                "id" => "265",
                "provinsi_id" => "27",
                "province" => "Sulawesi Barat",
                "type" => "Kabupaten",
                "nama" => "Mamuju",
                "postal_code" => "91519"
            ],
            [
                "id" => "266",
                "provinsi_id" => "27",
                "province" => "Sulawesi Barat",
                "type" => "Kabupaten",
                "nama" => "Mamuju Utara",
                "postal_code" => "91571"
            ],
            [
                "id" => "267",
                "provinsi_id" => "31",
                "province" => "Sulawesi Utara",
                "type" => "Kota",
                "nama" => "Manado",
                "postal_code" => "95247"
            ],
            [
                "id" => "268",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Mandailing Natal",
                "postal_code" => "22916"
            ],
            [
                "id" => "269",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Manggarai",
                "postal_code" => "86551"
            ],
            [
                "id" => "270",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Manggarai Barat",
                "postal_code" => "86711"
            ],
            [
                "id" => "271",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Manggarai Timur",
                "postal_code" => "86811"
            ],
            [
                "id" => "272",
                "provinsi_id" => "25",
                "province" => "Papua Barat",
                "type" => "Kabupaten",
                "nama" => "Manokwari",
                "postal_code" => "98311"
            ],
            [
                "id" => "273",
                "provinsi_id" => "25",
                "province" => "Papua Barat",
                "type" => "Kabupaten",
                "nama" => "Manokwari Selatan",
                "postal_code" => "98355"
            ],
            [
                "id" => "274",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Mappi",
                "postal_code" => "99853"
            ],
            [
                "id" => "275",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Maros",
                "postal_code" => "90511"
            ],
            [
                "id" => "276",
                "provinsi_id" => "22",
                "province" => "Nusa Tenggara Barat (NTB)",
                "type" => "Kota",
                "nama" => "Mataram",
                "postal_code" => "83131"
            ],
            [
                "id" => "277",
                "provinsi_id" => "25",
                "province" => "Papua Barat",
                "type" => "Kabupaten",
                "nama" => "Maybrat",
                "postal_code" => "98051"
            ],
            [
                "id" => "278",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kota",
                "nama" => "Medan",
                "postal_code" => "20228"
            ],
            [
                "id" => "279",
                "provinsi_id" => "12",
                "province" => "Kalimantan Barat",
                "type" => "Kabupaten",
                "nama" => "Melawi",
                "postal_code" => "78619"
            ],
            [
                "id" => "280",
                "provinsi_id" => "8",
                "province" => "Jambi",
                "type" => "Kabupaten",
                "nama" => "Merangin",
                "postal_code" => "37319"
            ],
            [
                "id" => "281",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Merauke",
                "postal_code" => "99613"
            ],
            [
                "id" => "282",
                "provinsi_id" => "18",
                "province" => "Lampung",
                "type" => "Kabupaten",
                "nama" => "Mesuji",
                "postal_code" => "34911"
            ],
            [
                "id" => "283",
                "provinsi_id" => "18",
                "province" => "Lampung",
                "type" => "Kota",
                "nama" => "Metro",
                "postal_code" => "34111"
            ],
            [
                "id" => "284",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Mimika",
                "postal_code" => "99962"
            ],
            [
                "id" => "285",
                "provinsi_id" => "31",
                "province" => "Sulawesi Utara",
                "type" => "Kabupaten",
                "nama" => "Minahasa",
                "postal_code" => "95614"
            ],
            [
                "id" => "286",
                "provinsi_id" => "31",
                "province" => "Sulawesi Utara",
                "type" => "Kabupaten",
                "nama" => "Minahasa Selatan",
                "postal_code" => "95914"
            ],
            [
                "id" => "287",
                "provinsi_id" => "31",
                "province" => "Sulawesi Utara",
                "type" => "Kabupaten",
                "nama" => "Minahasa Tenggara",
                "postal_code" => "95995"
            ],
            [
                "id" => "288",
                "provinsi_id" => "31",
                "province" => "Sulawesi Utara",
                "type" => "Kabupaten",
                "nama" => "Minahasa Utara",
                "postal_code" => "95316"
            ],
            [
                "id" => "289",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Mojokerto",
                "postal_code" => "61382"
            ],
            [
                "id" => "290",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kota",
                "nama" => "Mojokerto",
                "postal_code" => "61316"
            ],
            [
                "id" => "291",
                "provinsi_id" => "29",
                "province" => "Sulawesi Tengah",
                "type" => "Kabupaten",
                "nama" => "Morowali",
                "postal_code" => "94911"
            ],
            [
                "id" => "292",
                "provinsi_id" => "33",
                "province" => "Sumatera Selatan",
                "type" => "Kabupaten",
                "nama" => "Muara Enim",
                "postal_code" => "31315"
            ],
            [
                "id" => "293",
                "provinsi_id" => "8",
                "province" => "Jambi",
                "type" => "Kabupaten",
                "nama" => "Muaro Jambi",
                "postal_code" => "36311"
            ],
            [
                "id" => "294",
                "provinsi_id" => "4",
                "province" => "Bengkulu",
                "type" => "Kabupaten",
                "nama" => "Muko Muko",
                "postal_code" => "38715"
            ],
            [
                "id" => "295",
                "provinsi_id" => "30",
                "province" => "Sulawesi Tenggara",
                "type" => "Kabupaten",
                "nama" => "Muna",
                "postal_code" => "93611"
            ],
            [
                "id" => "296",
                "provinsi_id" => "14",
                "province" => "Kalimantan Tengah",
                "type" => "Kabupaten",
                "nama" => "Murung Raya",
                "postal_code" => "73911"
            ],
            [
                "id" => "297",
                "provinsi_id" => "33",
                "province" => "Sumatera Selatan",
                "type" => "Kabupaten",
                "nama" => "Musi Banyuasin",
                "postal_code" => "30719"
            ],
            [
                "id" => "298",
                "provinsi_id" => "33",
                "province" => "Sumatera Selatan",
                "type" => "Kabupaten",
                "nama" => "Musi Rawas",
                "postal_code" => "31661"
            ],
            [
                "id" => "299",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Nabire",
                "postal_code" => "98816"
            ],
            [
                "id" => "300",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kabupaten",
                "nama" => "Nagan Raya",
                "postal_code" => "23674"
            ],
            [
                "id" => "301",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Nagekeo",
                "postal_code" => "86911"
            ],
            [
                "id" => "302",
                "provinsi_id" => "17",
                "province" => "Kepulauan Riau",
                "type" => "Kabupaten",
                "nama" => "Natuna",
                "postal_code" => "29711"
            ],
            [
                "id" => "303",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Nduga",
                "postal_code" => "99541"
            ],
            [
                "id" => "304",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Ngada",
                "postal_code" => "86413"
            ],
            [
                "id" => "305",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Nganjuk",
                "postal_code" => "64414"
            ],
            [
                "id" => "306",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Ngawi",
                "postal_code" => "63219"
            ],
            [
                "id" => "307",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Nias",
                "postal_code" => "22876"
            ],
            [
                "id" => "308",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Nias Barat",
                "postal_code" => "22895"
            ],
            [
                "id" => "309",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Nias Selatan",
                "postal_code" => "22865"
            ],
            [
                "id" => "310",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Nias Utara",
                "postal_code" => "22856"
            ],
            [
                "id" => "311",
                "provinsi_id" => "16",
                "province" => "Kalimantan Utara",
                "type" => "Kabupaten",
                "nama" => "Nunukan",
                "postal_code" => "77421"
            ],
            [
                "id" => "312",
                "provinsi_id" => "33",
                "province" => "Sumatera Selatan",
                "type" => "Kabupaten",
                "nama" => "Ogan Ilir",
                "postal_code" => "30811"
            ],
            [
                "id" => "313",
                "provinsi_id" => "33",
                "province" => "Sumatera Selatan",
                "type" => "Kabupaten",
                "nama" => "Ogan Komering Ilir",
                "postal_code" => "30618"
            ],
            [
                "id" => "314",
                "provinsi_id" => "33",
                "province" => "Sumatera Selatan",
                "type" => "Kabupaten",
                "nama" => "Ogan Komering Ulu",
                "postal_code" => "32112"
            ],
            [
                "id" => "315",
                "provinsi_id" => "33",
                "province" => "Sumatera Selatan",
                "type" => "Kabupaten",
                "nama" => "Ogan Komering Ulu Selatan",
                "postal_code" => "32211"
            ],
            [
                "id" => "316",
                "provinsi_id" => "33",
                "province" => "Sumatera Selatan",
                "type" => "Kabupaten",
                "nama" => "Ogan Komering Ulu Timur",
                "postal_code" => "32312"
            ],
            [
                "id" => "317",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Pacitan",
                "postal_code" => "63512"
            ],
            [
                "id" => "318",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kota",
                "nama" => "Padang",
                "postal_code" => "25112"
            ],
            [
                "id" => "319",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Padang Lawas",
                "postal_code" => "22763"
            ],
            [
                "id" => "320",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Padang Lawas Utara",
                "postal_code" => "22753"
            ],
            [
                "id" => "321",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kota",
                "nama" => "Padang Panjang",
                "postal_code" => "27122"
            ],
            [
                "id" => "322",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kabupaten",
                "nama" => "Padang Pariaman",
                "postal_code" => "25583"
            ],
            [
                "id" => "323",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kota",
                "nama" => "Padang Sidempuan",
                "postal_code" => "22727"
            ],
            [
                "id" => "324",
                "provinsi_id" => "33",
                "province" => "Sumatera Selatan",
                "type" => "Kota",
                "nama" => "Pagar Alam",
                "postal_code" => "31512"
            ],
            [
                "id" => "325",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Pakpak Bharat",
                "postal_code" => "22272"
            ],
            [
                "id" => "326",
                "provinsi_id" => "14",
                "province" => "Kalimantan Tengah",
                "type" => "Kota",
                "nama" => "Palangka Raya",
                "postal_code" => "73112"
            ],
            [
                "id" => "327",
                "provinsi_id" => "33",
                "province" => "Sumatera Selatan",
                "type" => "Kota",
                "nama" => "Palembang",
                "postal_code" => "30111"
            ],
            [
                "id" => "328",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kota",
                "nama" => "Palopo",
                "postal_code" => "91911"
            ],
            [
                "id" => "329",
                "provinsi_id" => "29",
                "province" => "Sulawesi Tengah",
                "type" => "Kota",
                "nama" => "Palu",
                "postal_code" => "94111"
            ],
            [
                "id" => "330",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Pamekasan",
                "postal_code" => "69319"
            ],
            [
                "id" => "331",
                "provinsi_id" => "3",
                "province" => "Banten",
                "type" => "Kabupaten",
                "nama" => "Pandeglang",
                "postal_code" => "42212"
            ],
            [
                "id" => "332",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kabupaten",
                "nama" => "Pangandaran",
                "postal_code" => "46511"
            ],
            [
                "id" => "333",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Pangkajene Kepulauan",
                "postal_code" => "90611"
            ],
            [
                "id" => "334",
                "provinsi_id" => "2",
                "province" => "Bangka Belitung",
                "type" => "Kota",
                "nama" => "Pangkal Pinang",
                "postal_code" => "33115"
            ],
            [
                "id" => "335",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Paniai",
                "postal_code" => "98765"
            ],
            [
                "id" => "336",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kota",
                "nama" => "Parepare",
                "postal_code" => "91123"
            ],
            [
                "id" => "337",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kota",
                "nama" => "Pariaman",
                "postal_code" => "25511"
            ],
            [
                "id" => "338",
                "provinsi_id" => "29",
                "province" => "Sulawesi Tengah",
                "type" => "Kabupaten",
                "nama" => "Parigi Moutong",
                "postal_code" => "94411"
            ],
            [
                "id" => "339",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kabupaten",
                "nama" => "Pasaman",
                "postal_code" => "26318"
            ],
            [
                "id" => "340",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kabupaten",
                "nama" => "Pasaman Barat",
                "postal_code" => "26511"
            ],
            [
                "id" => "341",
                "provinsi_id" => "15",
                "province" => "Kalimantan Timur",
                "type" => "Kabupaten",
                "nama" => "Paser",
                "postal_code" => "76211"
            ],
            [
                "id" => "342",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Pasuruan",
                "postal_code" => "67153"
            ],
            [
                "id" => "343",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kota",
                "nama" => "Pasuruan",
                "postal_code" => "67118"
            ],
            [
                "id" => "344",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Pati",
                "postal_code" => "59114"
            ],
            [
                "id" => "345",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kota",
                "nama" => "Payakumbuh",
                "postal_code" => "26213"
            ],
            [
                "id" => "346",
                "provinsi_id" => "25",
                "province" => "Papua Barat",
                "type" => "Kabupaten",
                "nama" => "Pegunungan Arfak",
                "postal_code" => "98354"
            ],
            [
                "id" => "347",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Pegunungan Bintang",
                "postal_code" => "99573"
            ],
            [
                "id" => "348",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Pekalongan",
                "postal_code" => "51161"
            ],
            [
                "id" => "349",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kota",
                "nama" => "Pekalongan",
                "postal_code" => "51122"
            ],
            [
                "id" => "350",
                "provinsi_id" => "26",
                "province" => "Riau",
                "type" => "Kota",
                "nama" => "Pekanbaru",
                "postal_code" => "28112"
            ],
            [
                "id" => "351",
                "provinsi_id" => "26",
                "province" => "Riau",
                "type" => "Kabupaten",
                "nama" => "Pelalawan",
                "postal_code" => "28311"
            ],
            [
                "id" => "352",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Pemalang",
                "postal_code" => "52319"
            ],
            [
                "id" => "353",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kota",
                "nama" => "Pematang Siantar",
                "postal_code" => "21126"
            ],
            [
                "id" => "354",
                "provinsi_id" => "15",
                "province" => "Kalimantan Timur",
                "type" => "Kabupaten",
                "nama" => "Penajam Paser Utara",
                "postal_code" => "76311"
            ],
            [
                "id" => "355",
                "provinsi_id" => "18",
                "province" => "Lampung",
                "type" => "Kabupaten",
                "nama" => "Pesawaran",
                "postal_code" => "35312"
            ],
            [
                "id" => "356",
                "provinsi_id" => "18",
                "province" => "Lampung",
                "type" => "Kabupaten",
                "nama" => "Pesisir Barat",
                "postal_code" => "35974"
            ],
            [
                "id" => "357",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kabupaten",
                "nama" => "Pesisir Selatan",
                "postal_code" => "25611"
            ],
            [
                "id" => "358",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kabupaten",
                "nama" => "Pidie",
                "postal_code" => "24116"
            ],
            [
                "id" => "359",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kabupaten",
                "nama" => "Pidie Jaya",
                "postal_code" => "24186"
            ],
            [
                "id" => "360",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Pinrang",
                "postal_code" => "91251"
            ],
            [
                "id" => "361",
                "provinsi_id" => "7",
                "province" => "Gorontalo",
                "type" => "Kabupaten",
                "nama" => "Pohuwato",
                "postal_code" => "96419"
            ],
            [
                "id" => "362",
                "provinsi_id" => "27",
                "province" => "Sulawesi Barat",
                "type" => "Kabupaten",
                "nama" => "Polewali Mandar",
                "postal_code" => "91311"
            ],
            [
                "id" => "363",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Ponorogo",
                "postal_code" => "63411"
            ],
            [
                "id" => "364",
                "provinsi_id" => "12",
                "province" => "Kalimantan Barat",
                "type" => "Kabupaten",
                "nama" => "Pontianak",
                "postal_code" => "78971"
            ],
            [
                "id" => "365",
                "provinsi_id" => "12",
                "province" => "Kalimantan Barat",
                "type" => "Kota",
                "nama" => "Pontianak",
                "postal_code" => "78112"
            ],
            [
                "id" => "366",
                "provinsi_id" => "29",
                "province" => "Sulawesi Tengah",
                "type" => "Kabupaten",
                "nama" => "Poso",
                "postal_code" => "94615"
            ],
            [
                "id" => "367",
                "provinsi_id" => "33",
                "province" => "Sumatera Selatan",
                "type" => "Kota",
                "nama" => "Prabumulih",
                "postal_code" => "31121"
            ],
            [
                "id" => "368",
                "provinsi_id" => "18",
                "province" => "Lampung",
                "type" => "Kabupaten",
                "nama" => "Pringsewu",
                "postal_code" => "35719"
            ],
            [
                "id" => "369",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Probolinggo",
                "postal_code" => "67282"
            ],
            [
                "id" => "370",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kota",
                "nama" => "Probolinggo",
                "postal_code" => "67215"
            ],
            [
                "id" => "371",
                "provinsi_id" => "14",
                "province" => "Kalimantan Tengah",
                "type" => "Kabupaten",
                "nama" => "Pulang Pisau",
                "postal_code" => "74811"
            ],
            [
                "id" => "372",
                "provinsi_id" => "20",
                "province" => "Maluku Utara",
                "type" => "Kabupaten",
                "nama" => "Pulau Morotai",
                "postal_code" => "97771"
            ],
            [
                "id" => "373",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Puncak",
                "postal_code" => "98981"
            ],
            [
                "id" => "374",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Puncak Jaya",
                "postal_code" => "98979"
            ],
            [
                "id" => "375",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Purbalingga",
                "postal_code" => "53312"
            ],
            [
                "id" => "376",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kabupaten",
                "nama" => "Purwakarta",
                "postal_code" => "41119"
            ],
            [
                "id" => "377",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Purworejo",
                "postal_code" => "54111"
            ],
            [
                "id" => "378",
                "provinsi_id" => "25",
                "province" => "Papua Barat",
                "type" => "Kabupaten",
                "nama" => "Raja Ampat",
                "postal_code" => "98489"
            ],
            [
                "id" => "379",
                "provinsi_id" => "4",
                "province" => "Bengkulu",
                "type" => "Kabupaten",
                "nama" => "Rejang Lebong",
                "postal_code" => "39112"
            ],
            [
                "id" => "380",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Rembang",
                "postal_code" => "59219"
            ],
            [
                "id" => "381",
                "provinsi_id" => "26",
                "province" => "Riau",
                "type" => "Kabupaten",
                "nama" => "Rokan Hilir",
                "postal_code" => "28992"
            ],
            [
                "id" => "382",
                "provinsi_id" => "26",
                "province" => "Riau",
                "type" => "Kabupaten",
                "nama" => "Rokan Hulu",
                "postal_code" => "28511"
            ],
            [
                "id" => "383",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Rote Ndao",
                "postal_code" => "85982"
            ],
            [
                "id" => "384",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kota",
                "nama" => "Sabang",
                "postal_code" => "23512"
            ],
            [
                "id" => "385",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Sabu Raijua",
                "postal_code" => "85391"
            ],
            [
                "id" => "386",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kota",
                "nama" => "Salatiga",
                "postal_code" => "50711"
            ],
            [
                "id" => "387",
                "provinsi_id" => "15",
                "province" => "Kalimantan Timur",
                "type" => "Kota",
                "nama" => "Samarinda",
                "postal_code" => "75133"
            ],
            [
                "id" => "388",
                "provinsi_id" => "12",
                "province" => "Kalimantan Barat",
                "type" => "Kabupaten",
                "nama" => "Sambas",
                "postal_code" => "79453"
            ],
            [
                "id" => "389",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Samosir",
                "postal_code" => "22392"
            ],
            [
                "id" => "390",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Sampang",
                "postal_code" => "69219"
            ],
            [
                "id" => "391",
                "provinsi_id" => "12",
                "province" => "Kalimantan Barat",
                "type" => "Kabupaten",
                "nama" => "Sanggau",
                "postal_code" => "78557"
            ],
            [
                "id" => "392",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Sarmi",
                "postal_code" => "99373"
            ],
            [
                "id" => "393",
                "provinsi_id" => "8",
                "province" => "Jambi",
                "type" => "Kabupaten",
                "nama" => "Sarolangun",
                "postal_code" => "37419"
            ],
            [
                "id" => "394",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kota",
                "nama" => "Sawah Lunto",
                "postal_code" => "27416"
            ],
            [
                "id" => "395",
                "provinsi_id" => "12",
                "province" => "Kalimantan Barat",
                "type" => "Kabupaten",
                "nama" => "Sekadau",
                "postal_code" => "79583"
            ],
            [
                "id" => "396",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Selayar (Kepulauan Selayar)",
                "postal_code" => "92812"
            ],
            [
                "id" => "397",
                "provinsi_id" => "4",
                "province" => "Bengkulu",
                "type" => "Kabupaten",
                "nama" => "Seluma",
                "postal_code" => "38811"
            ],
            [
                "id" => "398",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Semarang",
                "postal_code" => "50511"
            ],
            [
                "id" => "399",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kota",
                "nama" => "Semarang",
                "postal_code" => "50135"
            ],
            [
                "id" => "400",
                "provinsi_id" => "19",
                "province" => "Maluku",
                "type" => "Kabupaten",
                "nama" => "Seram Bagian Barat",
                "postal_code" => "97561"
            ],
            [
                "id" => "401",
                "provinsi_id" => "19",
                "province" => "Maluku",
                "type" => "Kabupaten",
                "nama" => "Seram Bagian Timur",
                "postal_code" => "97581"
            ],
            [
                "id" => "402",
                "provinsi_id" => "3",
                "province" => "Banten",
                "type" => "Kabupaten",
                "nama" => "Serang",
                "postal_code" => "42182"
            ],
            [
                "id" => "403",
                "provinsi_id" => "3",
                "province" => "Banten",
                "type" => "Kota",
                "nama" => "Serang",
                "postal_code" => "42111"
            ],
            [
                "id" => "404",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Serdang Bedagai",
                "postal_code" => "20915"
            ],
            [
                "id" => "405",
                "provinsi_id" => "14",
                "province" => "Kalimantan Tengah",
                "type" => "Kabupaten",
                "nama" => "Seruyan",
                "postal_code" => "74211"
            ],
            [
                "id" => "406",
                "provinsi_id" => "26",
                "province" => "Riau",
                "type" => "Kabupaten",
                "nama" => "Siak",
                "postal_code" => "28623"
            ],
            [
                "id" => "407",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kota",
                "nama" => "Sibolga",
                "postal_code" => "22522"
            ],
            [
                "id" => "408",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Sidenreng Rappang/Rapang",
                "postal_code" => "91613"
            ],
            [
                "id" => "409",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Sidoarjo",
                "postal_code" => "61219"
            ],
            [
                "id" => "410",
                "provinsi_id" => "29",
                "province" => "Sulawesi Tengah",
                "type" => "Kabupaten",
                "nama" => "Sigi",
                "postal_code" => "94364"
            ],
            [
                "id" => "411",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kabupaten",
                "nama" => "Sijunjung (Sawah Lunto Sijunjung)",
                "postal_code" => "27511"
            ],
            [
                "id" => "412",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Sikka",
                "postal_code" => "86121"
            ],
            [
                "id" => "413",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Simalungun",
                "postal_code" => "21162"
            ],
            [
                "id" => "414",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kabupaten",
                "nama" => "Simeulue",
                "postal_code" => "23891"
            ],
            [
                "id" => "415",
                "provinsi_id" => "12",
                "province" => "Kalimantan Barat",
                "type" => "Kota",
                "nama" => "Singkawang",
                "postal_code" => "79117"
            ],
            [
                "id" => "416",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Sinjai",
                "postal_code" => "92615"
            ],
            [
                "id" => "417",
                "provinsi_id" => "12",
                "province" => "Kalimantan Barat",
                "type" => "Kabupaten",
                "nama" => "Sintang",
                "postal_code" => "78619"
            ],
            [
                "id" => "418",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Situbondo",
                "postal_code" => "68316"
            ],
            [
                "id" => "419",
                "provinsi_id" => "5",
                "province" => "DI Yogyakarta",
                "type" => "Kabupaten",
                "nama" => "Sleman",
                "postal_code" => "55513"
            ],
            [
                "id" => "420",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kabupaten",
                "nama" => "Solok",
                "postal_code" => "27365"
            ],
            [
                "id" => "421",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kota",
                "nama" => "Solok",
                "postal_code" => "27315"
            ],
            [
                "id" => "422",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kabupaten",
                "nama" => "Solok Selatan",
                "postal_code" => "27779"
            ],
            [
                "id" => "423",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Soppeng",
                "postal_code" => "90812"
            ],
            [
                "id" => "424",
                "provinsi_id" => "25",
                "province" => "Papua Barat",
                "type" => "Kabupaten",
                "nama" => "Sorong",
                "postal_code" => "98431"
            ],
            [
                "id" => "425",
                "provinsi_id" => "25",
                "province" => "Papua Barat",
                "type" => "Kota",
                "nama" => "Sorong",
                "postal_code" => "98411"
            ],
            [
                "id" => "426",
                "provinsi_id" => "25",
                "province" => "Papua Barat",
                "type" => "Kabupaten",
                "nama" => "Sorong Selatan",
                "postal_code" => "98454"
            ],
            [
                "id" => "427",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Sragen",
                "postal_code" => "57211"
            ],
            [
                "id" => "428",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kabupaten",
                "nama" => "Subang",
                "postal_code" => "41215"
            ],
            [
                "id" => "429",
                "provinsi_id" => "21",
                "province" => "Nanggroe Aceh Darussalam (NAD)",
                "type" => "Kota",
                "nama" => "Subulussalam",
                "postal_code" => "24882"
            ],
            [
                "id" => "430",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kabupaten",
                "nama" => "Sukabumi",
                "postal_code" => "43311"
            ],
            [
                "id" => "431",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kota",
                "nama" => "Sukabumi",
                "postal_code" => "43114"
            ],
            [
                "id" => "432",
                "provinsi_id" => "14",
                "province" => "Kalimantan Tengah",
                "type" => "Kabupaten",
                "nama" => "Sukamara",
                "postal_code" => "74712"
            ],
            [
                "id" => "433",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Sukoharjo",
                "postal_code" => "57514"
            ],
            [
                "id" => "434",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Sumba Barat",
                "postal_code" => "87219"
            ],
            [
                "id" => "435",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Sumba Barat Daya",
                "postal_code" => "87453"
            ],
            [
                "id" => "436",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Sumba Tengah",
                "postal_code" => "87358"
            ],
            [
                "id" => "437",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Sumba Timur",
                "postal_code" => "87112"
            ],
            [
                "id" => "438",
                "provinsi_id" => "22",
                "province" => "Nusa Tenggara Barat (NTB)",
                "type" => "Kabupaten",
                "nama" => "Sumbawa",
                "postal_code" => "84315"
            ],
            [
                "id" => "439",
                "provinsi_id" => "22",
                "province" => "Nusa Tenggara Barat (NTB)",
                "type" => "Kabupaten",
                "nama" => "Sumbawa Barat",
                "postal_code" => "84419"
            ],
            [
                "id" => "440",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kabupaten",
                "nama" => "Sumedang",
                "postal_code" => "45326"
            ],
            [
                "id" => "441",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Sumenep",
                "postal_code" => "69413"
            ],
            [
                "id" => "442",
                "provinsi_id" => "8",
                "province" => "Jambi",
                "type" => "Kota",
                "nama" => "Sungaipenuh",
                "postal_code" => "37113"
            ],
            [
                "id" => "443",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Supiori",
                "postal_code" => "98164"
            ],
            [
                "id" => "444",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kota",
                "nama" => "Surabaya",
                "postal_code" => "60119"
            ],
            [
                "id" => "445",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kota",
                "nama" => "Surakarta (Solo)",
                "postal_code" => "57113"
            ],
            [
                "id" => "446",
                "provinsi_id" => "13",
                "province" => "Kalimantan Selatan",
                "type" => "Kabupaten",
                "nama" => "Tabalong",
                "postal_code" => "71513"
            ],
            [
                "id" => "447",
                "provinsi_id" => "1",
                "province" => "Bali",
                "type" => "Kabupaten",
                "nama" => "Tabanan",
                "postal_code" => "82119"
            ],
            [
                "id" => "448",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Takalar",
                "postal_code" => "92212"
            ],
            [
                "id" => "449",
                "provinsi_id" => "25",
                "province" => "Papua Barat",
                "type" => "Kabupaten",
                "nama" => "Tambrauw",
                "postal_code" => "98475"
            ],
            [
                "id" => "450",
                "provinsi_id" => "16",
                "province" => "Kalimantan Utara",
                "type" => "Kabupaten",
                "nama" => "Tana Tidung",
                "postal_code" => "77611"
            ],
            [
                "id" => "451",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Tana Toraja",
                "postal_code" => "91819"
            ],
            [
                "id" => "452",
                "provinsi_id" => "13",
                "province" => "Kalimantan Selatan",
                "type" => "Kabupaten",
                "nama" => "Tanah Bumbu",
                "postal_code" => "72211"
            ],
            [
                "id" => "453",
                "provinsi_id" => "32",
                "province" => "Sumatera Barat",
                "type" => "Kabupaten",
                "nama" => "Tanah Datar",
                "postal_code" => "27211"
            ],
            [
                "id" => "454",
                "provinsi_id" => "13",
                "province" => "Kalimantan Selatan",
                "type" => "Kabupaten",
                "nama" => "Tanah Laut",
                "postal_code" => "70811"
            ],
            [
                "id" => "455",
                "provinsi_id" => "3",
                "province" => "Banten",
                "type" => "Kabupaten",
                "nama" => "Tangerang",
                "postal_code" => "15914"
            ],
            [
                "id" => "456",
                "provinsi_id" => "3",
                "province" => "Banten",
                "type" => "Kota",
                "nama" => "Tangerang",
                "postal_code" => "15111"
            ],
            [
                "id" => "457",
                "provinsi_id" => "3",
                "province" => "Banten",
                "type" => "Kota",
                "nama" => "Tangerang Selatan",
                "postal_code" => "15435"
            ],
            [
                "id" => "458",
                "provinsi_id" => "18",
                "province" => "Lampung",
                "type" => "Kabupaten",
                "nama" => "Tanggamus",
                "postal_code" => "35619"
            ],
            [
                "id" => "459",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kota",
                "nama" => "Tanjung Balai",
                "postal_code" => "21321"
            ],
            [
                "id" => "460",
                "provinsi_id" => "8",
                "province" => "Jambi",
                "type" => "Kabupaten",
                "nama" => "Tanjung Jabung Barat",
                "postal_code" => "36513"
            ],
            [
                "id" => "461",
                "provinsi_id" => "8",
                "province" => "Jambi",
                "type" => "Kabupaten",
                "nama" => "Tanjung Jabung Timur",
                "postal_code" => "36719"
            ],
            [
                "id" => "462",
                "provinsi_id" => "17",
                "province" => "Kepulauan Riau",
                "type" => "Kota",
                "nama" => "Tanjung Pinang",
                "postal_code" => "29111"
            ],
            [
                "id" => "463",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Tapanuli Selatan",
                "postal_code" => "22742"
            ],
            [
                "id" => "464",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Tapanuli Tengah",
                "postal_code" => "22611"
            ],
            [
                "id" => "465",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Tapanuli Utara",
                "postal_code" => "22414"
            ],
            [
                "id" => "466",
                "provinsi_id" => "13",
                "province" => "Kalimantan Selatan",
                "type" => "Kabupaten",
                "nama" => "Tapin",
                "postal_code" => "71119"
            ],
            [
                "id" => "467",
                "provinsi_id" => "16",
                "province" => "Kalimantan Utara",
                "type" => "Kota",
                "nama" => "Tarakan",
                "postal_code" => "77114"
            ],
            [
                "id" => "468",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kabupaten",
                "nama" => "Tasikmalaya",
                "postal_code" => "46411"
            ],
            [
                "id" => "469",
                "provinsi_id" => "9",
                "province" => "Jawa Barat",
                "type" => "Kota",
                "nama" => "Tasikmalaya",
                "postal_code" => "46116"
            ],
            [
                "id" => "470",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kota",
                "nama" => "Tebing Tinggi",
                "postal_code" => "20632"
            ],
            [
                "id" => "471",
                "provinsi_id" => "8",
                "province" => "Jambi",
                "type" => "Kabupaten",
                "nama" => "Tebo",
                "postal_code" => "37519"
            ],
            [
                "id" => "472",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Tegal",
                "postal_code" => "52419"
            ],
            [
                "id" => "473",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kota",
                "nama" => "Tegal",
                "postal_code" => "52114"
            ],
            [
                "id" => "474",
                "provinsi_id" => "25",
                "province" => "Papua Barat",
                "type" => "Kabupaten",
                "nama" => "Teluk Bintuni",
                "postal_code" => "98551"
            ],
            [
                "id" => "475",
                "provinsi_id" => "25",
                "province" => "Papua Barat",
                "type" => "Kabupaten",
                "nama" => "Teluk Wondama",
                "postal_code" => "98591"
            ],
            [
                "id" => "476",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Temanggung",
                "postal_code" => "56212"
            ],
            [
                "id" => "477",
                "provinsi_id" => "20",
                "province" => "Maluku Utara",
                "type" => "Kota",
                "nama" => "Ternate",
                "postal_code" => "97714"
            ],
            [
                "id" => "478",
                "provinsi_id" => "20",
                "province" => "Maluku Utara",
                "type" => "Kota",
                "nama" => "Tidore Kepulauan",
                "postal_code" => "97815"
            ],
            [
                "id" => "479",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Timor Tengah Selatan",
                "postal_code" => "85562"
            ],
            [
                "id" => "480",
                "provinsi_id" => "23",
                "province" => "Nusa Tenggara Timur (NTT)",
                "type" => "Kabupaten",
                "nama" => "Timor Tengah Utara",
                "postal_code" => "85612"
            ],
            [
                "id" => "481",
                "provinsi_id" => "34",
                "province" => "Sumatera Utara",
                "type" => "Kabupaten",
                "nama" => "Toba Samosir",
                "postal_code" => "22316"
            ],
            [
                "id" => "482",
                "provinsi_id" => "29",
                "province" => "Sulawesi Tengah",
                "type" => "Kabupaten",
                "nama" => "Tojo Una-Una",
                "postal_code" => "94683"
            ],
            [
                "id" => "483",
                "provinsi_id" => "29",
                "province" => "Sulawesi Tengah",
                "type" => "Kabupaten",
                "nama" => "Toli-Toli",
                "postal_code" => "94542"
            ],
            [
                "id" => "484",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Tolikara",
                "postal_code" => "99411"
            ],
            [
                "id" => "485",
                "provinsi_id" => "31",
                "province" => "Sulawesi Utara",
                "type" => "Kota",
                "nama" => "Tomohon",
                "postal_code" => "95416"
            ],
            [
                "id" => "486",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Toraja Utara",
                "postal_code" => "91831"
            ],
            [
                "id" => "487",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Trenggalek",
                "postal_code" => "66312"
            ],
            [
                "id" => "488",
                "provinsi_id" => "19",
                "province" => "Maluku",
                "type" => "Kota",
                "nama" => "Tual",
                "postal_code" => "97612"
            ],
            [
                "id" => "489",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Tuban",
                "postal_code" => "62319"
            ],
            [
                "id" => "490",
                "provinsi_id" => "18",
                "province" => "Lampung",
                "type" => "Kabupaten",
                "nama" => "Tulang Bawang",
                "postal_code" => "34613"
            ],
            [
                "id" => "491",
                "provinsi_id" => "18",
                "province" => "Lampung",
                "type" => "Kabupaten",
                "nama" => "Tulang Bawang Barat",
                "postal_code" => "34419"
            ],
            [
                "id" => "492",
                "provinsi_id" => "11",
                "province" => "Jawa Timur",
                "type" => "Kabupaten",
                "nama" => "Tulungagung",
                "postal_code" => "66212"
            ],
            [
                "id" => "493",
                "provinsi_id" => "28",
                "province" => "Sulawesi Selatan",
                "type" => "Kabupaten",
                "nama" => "Wajo",
                "postal_code" => "90911"
            ],
            [
                "id" => "494",
                "provinsi_id" => "30",
                "province" => "Sulawesi Tenggara",
                "type" => "Kabupaten",
                "nama" => "Wakatobi",
                "postal_code" => "93791"
            ],
            [
                "id" => "495",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Waropen",
                "postal_code" => "98269"
            ],
            [
                "id" => "496",
                "provinsi_id" => "18",
                "province" => "Lampung",
                "type" => "Kabupaten",
                "nama" => "Way Kanan",
                "postal_code" => "34711"
            ],
            [
                "id" => "497",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Wonogiri",
                "postal_code" => "57619"
            ],
            [
                "id" => "498",
                "provinsi_id" => "10",
                "province" => "Jawa Tengah",
                "type" => "Kabupaten",
                "nama" => "Wonosobo",
                "postal_code" => "56311"
            ],
            [
                "id" => "499",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Yahukimo",
                "postal_code" => "99041"
            ],
            [
                "id" => "500",
                "provinsi_id" => "24",
                "province" => "Papua",
                "type" => "Kabupaten",
                "nama" => "Yalimo",
                "postal_code" => "99481"
            ],
            [
                "id" => "501",
                "provinsi_id" => "5",
                "province" => "DI Yogyakarta",
                "type" => "Kota",
                "nama" => "Yogyakarta",
                "postal_code" => "55111"
            ]
            ]);

        $kotas = $kotas->map(function($kota) {
            return [
                'id' => $kota['id'],
                'provinsi_id' => $kota['provinsi_id'],
                'nama' => $kota['nama']
            ];
        })->toArray();

        Kota::insert($kotas);
    }
}
