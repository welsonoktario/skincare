<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::query()
            ->insert(
                [
                    0 => [
                      'nama' => 'BANK BCA (BANK CENTRAL ASIA)',
                      'kode' => '014',
                    ],
                    1 => [
                      'nama' => 'BANK MANDIRI',
                      'kode' => '008',
                    ],
                    2 => [
                      'nama' => 'BANK BNI (BANK NEGARA INDONESIA)',
                      'kode' => '009',
                    ],
                    3 => [
                      'nama' => 'BANK SYARIAH INDONESIA (Eks BNI SYARIAH)',
                      'kode' => '427',
                    ],
                    4 => [
                      'nama' => 'BANK BRI (BANK RAKYAT INDONESIA)',
                      'kode' => '002',
                    ],
                    5 => [
                      'nama' => 'BANK SYARIAH INDONESIA (Eks BSM)',
                      'kode' => '451',
                    ],
                    6 => [
                      'nama' => 'BANK CIMB NIAGA',
                      'kode' => '022',
                    ],
                    7 => [
                      'nama' => 'BANK CIMB NIAGA SYARIAH',
                      'kode' => '022',
                    ],
                    8 => [
                      'nama' => 'BANK MUAMALAT',
                      'kode' => '147',
                    ],
                    9 => [
                      'nama' => 'BANK BTPN (BANK TABUNGAN PENSIUNAN NASIONAL)',
                      'kode' => '213',
                    ],
                    10 => [
                      'nama' => 'BANK BTPN SYARIAH',
                      'kode' => '547',
                    ],
                    11 => [
                      'nama' => 'JENIUS',
                      'kode' => '213',
                    ],
                    12 => [
                      'nama' => 'BANK SYARIAH INDONESIA (Eks BRI SYARIAH)',
                      'kode' => '422',
                    ],
                    13 => [
                      'nama' => 'BANK TABUNGAN NEGARA (BANK BTN)',
                      'kode' => '200',
                    ],
                    14 => [
                      'nama' => 'PERMATA BANK',
                      'kode' => '013',
                    ],
                    15 => [
                      'nama' => 'BANK DANAMON',
                      'kode' => '011',
                    ],
                    16 => [
                      'nama' => 'BANK BII MAYBANK',
                      'kode' => '016',
                    ],
                    17 => [
                      'nama' => 'BANK MEGA',
                      'kode' => '426',
                    ],
                    18 => [
                      'nama' => 'BANK SINARMAS',
                      'kode' => '153',
                    ],
                    19 => [
                      'nama' => 'BANK COMMONWEALTH',
                      'kode' => '950',
                    ],
                    20 => [
                      'nama' => 'BANK OCBC NISP',
                      'kode' => '028',
                    ],
                    21 => [
                      'nama' => 'BANK BUKOPIN',
                      'kode' => '441',
                    ],
                    22 => [
                      'nama' => 'BANK BUKOPIN SYARIAH',
                      'kode' => '521',
                    ],
                    23 => [
                      'nama' => 'BANK BCA SYARIAH',
                      'kode' => '536',
                    ],
                    24 => [
                      'nama' => 'BANK LIPPO',
                      'kode' => '026',
                    ],
                    25 => [
                      'nama' => 'CITIBANK',
                      'kode' => '031',
                    ],
                    26 => [
                      'nama' => 'INDOSAT DOMPETKU',
                      'kode' => '789',
                    ],
                    27 => [
                      'nama' => 'TELKOMSEL TCASH',
                      'kode' => '911',
                    ],
                    28 => [
                      'nama' => 'LINKAJA',
                      'kode' => '911',
                    ],
                    29 => [
                      'nama' => 'BANK DBS INDONESIA',
                      'kode' => '046',
                    ],
                    30 => [
                      'nama' => 'DIGIBANK',
                      'kode' => '046',
                    ],
                    31 => [
                      'nama' => 'SEABANK (Eks BANK KESEJAHTERAAN EKONOMI)',
                      'kode' => '535',
                    ],
                    32 => [
                      'nama' => 'BANK JAGO (Eks BANK ARTOS INDONESIA)',
                      'kode' => '542',
                    ],
                    33 => [
                      'nama' => 'BANK UOB INDONESIA',
                      'kode' => '023',
                    ],
                    34 => [
                      'nama' => 'TMRW by UOB INDONESIA',
                      'kode' => '023',
                    ],
                    35 => [
                      'nama' => 'BANK NEO COMMERCE (Akulaku)',
                      'kode' => '490',
                    ],
                    36 => [
                      'nama' => 'ALLO BANK (Eks BANK HARDA)',
                      'kode' => '567',
                    ],
                    37 => [
                      'nama' => 'BANK ALADIN (Eks BANK MAYBANK INDOCORP)',
                      'kode' => '947',
                    ],
                    38 => [
                      'nama' => 'BANK JABAR dan BANTEN (BJB)',
                      'kode' => '110',
                    ],
                    39 => [
                      'nama' => 'BANK DKI JAKARTA',
                      'kode' => '111',
                    ],
                    40 => [
                      'nama' => 'BPD DIY (YOGYAKARTA)',
                      'kode' => '112',
                    ],
                    41 => [
                      'nama' => 'BANK JATENG (JAWA TENGAH)',
                      'kode' => '113',
                    ],
                    42 => [
                      'nama' => 'BANK JATIM (JAWA BARAT)',
                      'kode' => '114',
                    ],
                    43 => [
                      'nama' => 'BPD JAMBI',
                      'kode' => '115',
                    ],
                    44 => [
                      'nama' => 'BPD ACEH',
                      'kode' => '116',
                    ],
                    45 => [
                      'nama' => 'BPD ACEH SYARIAH',
                      'kode' => '116',
                    ],
                    46 => [
                      'nama' => 'BANK SUMUT',
                      'kode' => '117',
                    ],
                    47 => [
                      'nama' => 'BANK NAGARI (BANK SUMBAR)',
                      'kode' => '118',
                    ],
                    48 => [
                      'nama' => 'BANK RIAU KEPRI',
                      'kode' => '119',
                    ],
                    49 => [
                      'nama' => 'BANK SUMSEL BABEL',
                      'kode' => '120',
                    ],
                    50 => [
                      'nama' => 'BANK LAMPUNG',
                      'kode' => '121',
                    ],
                    51 => [
                      'nama' => 'BANK KALSEL (BANK KALIMANTAN SELATAN)',
                      'kode' => '122',
                    ],
                    52 => [
                      'nama' => 'BANK KALBAR (BANK KALIMANTAN BARAT)',
                      'kode' => '123',
                    ],
                    53 => [
                      'nama' => 'BANK KALTIMTARA (BANK KALIMANTAN TIMUR DAN UTARA)',
                      'kode' => '124',
                    ],
                    54 => [
                      'nama' => 'BANK KALTENG (BANK KALIMANTAN TENGAH)',
                      'kode' => '125',
                    ],
                    55 => [
                      'nama' => 'BANK SULSELBAR (BANK SULAWESI SELATAN DAN BARAT)',
                      'kode' => '126',
                    ],
                    56 => [
                      'nama' => 'BANK SULUTGO (BANK SULAWESI UTARA DAN GORONTALO)',
                      'kode' => '127',
                    ],
                    57 => [
                      'nama' => 'BANK NTB',
                      'kode' => '128',
                    ],
                    58 => [
                      'nama' => 'BANK NTB SYARIAH',
                      'kode' => '128',
                    ],
                    59 => [
                      'nama' => 'BANK BPD BALI',
                      'kode' => '129',
                    ],
                    60 => [
                      'nama' => 'BANK NTT',
                      'kode' => '130',
                    ],
                    61 => [
                      'nama' => 'BANK MALUKU MALUT',
                      'kode' => '131',
                    ],
                    62 => [
                      'nama' => 'BANK PAPUA',
                      'kode' => '132',
                    ],
                    63 => [
                      'nama' => 'BANK BENGKULU',
                      'kode' => '133',
                    ],
                    64 => [
                      'nama' => 'BANK SULTENG (BANK SULAWESI TENGAH)',
                      'kode' => '134',
                    ],
                    65 => [
                      'nama' => 'BANK SULTRA',
                      'kode' => '135',
                    ],
                    66 => [
                      'nama' => 'BANK BPD BANTEN',
                      'kode' => '137',
                    ],
                    67 => [
                      'nama' => 'BANK EKSPOR INDONESIA',
                      'kode' => '003',
                    ],
                    68 => [
                      'nama' => 'BANK PANIN',
                      'kode' => '019',
                    ],
                    69 => [
                      'nama' => 'BANK PANIN DUBAI SYARIAH',
                      'kode' => '517',
                    ],
                    70 => [
                      'nama' => 'BANK ARTA NIAGA KENCANA',
                      'kode' => '020',
                    ],
                    71 => [
                      'nama' => 'BANK UOB INDONESIA (BANK BUANA INDONESIA)',
                      'kode' => '023',
                    ],
                    72 => [
                      'nama' => 'AMERICAN EXPRESS BANK LTD',
                      'kode' => '030',
                    ],
                    73 => [
                      'nama' => 'CITIBANK N.A.',
                      'kode' => '031',
                    ],
                    74 => [
                      'nama' => 'JP. MORGAN CHASE BANK, N.A.',
                      'kode' => '032',
                    ],
                    75 => [
                      'nama' => 'BANK OF AMERICA, N.A',
                      'kode' => '033',
                    ],
                    76 => [
                      'nama' => 'ING INDONESIA BANK',
                      'kode' => '034',
                    ],
                    77 => [
                      'nama' => 'BANK MULTICOR',
                      'kode' => '036',
                    ],
                    78 => [
                      'nama' => 'BANK ARTHA GRAHA INTERNASIONAL',
                      'kode' => '037',
                    ],
                    79 => [
                      'nama' => 'BANK CREDIT AGRICOLE INDOSUEZ',
                      'kode' => '039',
                    ],
                    80 => [
                      'nama' => 'THE BANGKOK BANK COMP. LTD',
                      'kode' => '040',
                    ],
                    81 => [
                      'nama' => 'THE HONGKONG & SHANGHAI B.C. (BANK HSBC)',
                      'kode' => '041',
                    ],
                    82 => [
                      'nama' => 'THE BANK OF TOKYO MITSUBISHI UFJ LTD',
                      'kode' => '042',
                    ],
                    83 => [
                      'nama' => 'BANK SUMITOMO MITSUI INDONESIA',
                      'kode' => '045',
                    ],
                    84 => [
                      'nama' => 'BANK RESONA PERDANIA',
                      'kode' => '047',
                    ],
                    85 => [
                      'nama' => 'BANK MIZUHO INDONESIA',
                      'kode' => '048',
                    ],
                    86 => [
                      'nama' => 'STANDARD CHARTERED BANK',
                      'kode' => '050',
                    ],
                    87 => [
                      'nama' => 'BANK ABN AMRO',
                      'kode' => '052',
                    ],
                    88 => [
                      'nama' => 'BANK KEPPEL TATLEE BUANA',
                      'kode' => '053',
                    ],
                    89 => [
                      'nama' => 'BANK CAPITAL INDONESIA',
                      'kode' => '054',
                    ],
                    90 => [
                      'nama' => 'BANK BNP PARIBAS INDONESIA',
                      'kode' => '057',
                    ],
                    91 => [
                      'nama' => 'BANK UOB INDONESIA',
                      'kode' => '023',
                    ],
                    92 => [
                      'nama' => 'KOREA EXCHANGE BANK DANAMON',
                      'kode' => '059',
                    ],
                    93 => [
                      'nama' => 'RABOBANK INTERNASIONAL INDONESIA',
                      'kode' => '060',
                    ],
                    94 => [
                      'nama' => 'BANK ANZ INDONESIA',
                      'kode' => '061',
                    ],
                    95 => [
                      'nama' => 'BANK WOORI SAUDARA',
                      'kode' => '068',
                    ],
                    96 => [
                      'nama' => 'BANK OF CHINA',
                      'kode' => '069',
                    ],
                    97 => [
                      'nama' => 'BANK BUMI ARTA',
                      'kode' => '076',
                    ],
                    98 => [
                      'nama' => 'BANK EKONOMI',
                      'kode' => '087',
                    ],
                    99 => [
                      'nama' => 'BANK ANTARDAERAH',
                      'kode' => '088',
                    ],
                    100 => [
                      'nama' => 'BANK HAGA',
                      'kode' => '089',
                    ],
                    101 => [
                      'nama' => 'BANK IFI',
                      'kode' => '093',
                    ],
                    102 => [
                      'nama' => 'BANK CENTURY',
                      'kode' => '095',
                    ],
                    103 => [
                      'nama' => 'BANK MAYAPADA',
                      'kode' => '097',
                    ],
                    104 => [
                      'nama' => 'BANK NUSANTARA PARAHYANGAN',
                      'kode' => '145',
                    ],
                    105 => [
                      'nama' => 'BANK SWADESI (BANK OF INDIA INDONESIA)',
                      'kode' => '146',
                    ],
                    106 => [
                      'nama' => 'BANK MESTIKA DHARMA',
                      'kode' => '151',
                    ],
                    107 => [
                      'nama' => 'BANK SHINHAN INDONESIA (BANK METRO EXPRESS)',
                      'kode' => '152',
                    ],
                    108 => [
                      'nama' => 'BANK MASPION INDONESIA',
                      'kode' => '157',
                    ],
                    109 => [
                      'nama' => 'BANK HAGAKITA',
                      'kode' => '159',
                    ],
                    110 => [
                      'nama' => 'BANK GANESHA',
                      'kode' => '161',
                    ],
                    111 => [
                      'nama' => 'BANK WINDU KENTJANA',
                      'kode' => '162',
                    ],
                    112 => [
                      'nama' => 'BANK ICBC INDONESIA (HALIM INDONESIA BANK)',
                      'kode' => '164',
                    ],
                    113 => [
                      'nama' => 'BANK HARMONI INTERNATIONAL',
                      'kode' => '166',
                    ],
                    114 => [
                      'nama' => 'BANK QNB KESAWAN (BANK QNB INDONESIA)',
                      'kode' => '167',
                    ],
                    115 => [
                      'nama' => 'BANK HIMPUNAN SAUDARA 1906',
                      'kode' => '212',
                    ],
                    116 => [
                      'nama' => 'BANK SWAGUNA',
                      'kode' => '405',
                    ],
                    117 => [
                      'nama' => 'BANK BISNIS INTERNASIONAL',
                      'kode' => '459',
                    ],
                    118 => [
                      'nama' => 'BANK SRI PARTHA',
                      'kode' => '466',
                    ],
                    119 => [
                      'nama' => 'BANK JASA JAKARTA',
                      'kode' => '472',
                    ],
                    120 => [
                      'nama' => 'BANK BINTANG MANUNGGAL',
                      'kode' => '484',
                    ],
                    121 => [
                      'nama' => 'BANK MNC INTERNASIONAL (BANK BUMIPUTERA)',
                      'kode' => '485',
                    ],
                    122 => [
                      'nama' => 'BANK YUDHA BHAKTI',
                      'kode' => '490',
                    ],
                    123 => [
                      'nama' => 'BANK MITRANIAGA',
                      'kode' => '491',
                    ],
                    124 => [
                      'nama' => 'BANK BRI AGRO NIAGA',
                      'kode' => '494',
                    ],
                    125 => [
                      'nama' => 'BANK SBI INDONESIA (BANK INDOMONEX)',
                      'kode' => '498',
                    ],
                    126 => [
                      'nama' => 'BANK ROYAL INDONESIA',
                      'kode' => '501',
                    ],
                    127 => [
                      'nama' => 'BANK NATIONAL NOBU (BANK ALFINDO)',
                      'kode' => '503',
                    ],
                    128 => [
                      'nama' => 'BANK MEGA SYARIAH',
                      'kode' => '506',
                    ],
                    129 => [
                      'nama' => 'BANK INA PERDANA',
                      'kode' => '513',
                    ],
                    130 => [
                      'nama' => 'BANK HARFA',
                      'kode' => '517',
                    ],
                    131 => [
                      'nama' => 'PRIMA MASTER BANK',
                      'kode' => '520',
                    ],
                    132 => [
                      'nama' => 'BANK PERSYARIKATAN INDONESIA',
                      'kode' => '521',
                    ],
                    133 => [
                      'nama' => 'BANK AKITA',
                      'kode' => '525',
                    ],
                    134 => [
                      'nama' => 'LIMAN INTERNATIONAL BANK',
                      'kode' => '526',
                    ],
                    135 => [
                      'nama' => 'ANGLOMAS INTERNASIONAL BANK',
                      'kode' => '531',
                    ],
                    136 => [
                      'nama' => 'BANK SAHABAT SAMPEORNA (BANK DIPO INTERNATIONAL)',
                      'kode' => '523',
                    ],
                    137 => [
                      'nama' => 'BANK PURBA DANARTA',
                      'kode' => '547',
                    ],
                    138 => [
                      'nama' => 'BANK MULTI ARTA SENTOSA',
                      'kode' => '548',
                    ],
                    139 => [
                      'nama' => 'BANK MAYORA INDONESIA',
                      'kode' => '553',
                    ],
                    140 => [
                      'nama' => 'BANK INDEX SELINDO',
                      'kode' => '555',
                    ],
                    141 => [
                      'nama' => 'BANK VICTORIA INTERNATIONAL',
                      'kode' => '566',
                    ],
                    142 => [
                      'nama' => 'BANK EKSEKUTIF',
                      'kode' => '558',
                    ],
                    143 => [
                      'nama' => 'CENTRATAMA NASIONAL BANK',
                      'kode' => '559',
                    ],
                    144 => [
                      'nama' => 'BANK FAMA INTERNASIONAL',
                      'kode' => '562',
                    ],
                    145 => [
                      'nama' => 'BANK MANDIRI TASPEN POS (BANK SINAR HARAPAN BALI)',
                      'kode' => '564',
                    ],
                    146 => [
                      'nama' => 'BANK AGRIS (BANK FINCONESIA)',
                      'kode' => '945',
                    ],
                    147 => [
                      'nama' => 'BANK MERINCORP',
                      'kode' => '946',
                    ],
                    148 => [
                      'nama' => 'BANK OCBC – INDONESIA',
                      'kode' => '948',
                    ],
                    149 => [
                      'nama' => 'BANK CTBC (CHINA TRUST) INDONESIA',
                      'kode' => '949',
                    ],
                    150 => [
                      'nama' => 'BANK BJB SYARIAH',
                      'kode' => '425',
                    ],
                    151 => [
                      'nama' => 'BPR KS (KARYAJATNIKA SEDAYA)',
                      'kode' => '688',
                    ],
                  ]
            );
    }
}
