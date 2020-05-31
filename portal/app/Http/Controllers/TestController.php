<?php

namespace App\Http\Controllers;

use App\Addresslog;
use App\Parcel;
use App\Test;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class TestController extends Controller
{

    public function __construct()
	{
		//$this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cities = array(
            0 => array('city_name' => 'ABBOTABAD', 'delivery_time' => '4-5 DAYS'),
            2 => array('city_name' => 'ADDA JOHAL 97 / RB', 'delivery_time' => '5-6 DAYS'),
            1 => array('city_name' => 'ABDUL HAKIM', 'delivery_time' => '5-6 DAYS'),
            3 => array('city_name' => 'ADDA SHEIKH WAN', 'delivery_time' => '5-6 DAYS'),
            4 => array('city_name' => 'ADDA SIRAJ', 'delivery_time' => '5-6 DAYS'),
            5 => array('city_name' => 'AHMED PUR EAST', 'delivery_time' => '5-6 DAYS'),
            6 => array('city_name' => 'AHMED PUR SIAL', 'delivery_time' => '5-6 DAYS'),
            7 => array('city_name' => 'AJNIA WALA', 'delivery_time' => '5-6 DAYS'),
            8 => array('city_name' => 'AKHTAR ABAD', 'delivery_time' => '5-6 DAYS'),
            9 => array('city_name' => 'AKORA KHATAK', 'delivery_time' => '6-7 DAYS'),
            10 => array('city_name' => 'ALI PUR CHATHA', 'delivery_time' => '5-6 DAYS'),
            11 => array('city_name' => 'ALIPUR', 'delivery_time' => '5-6 DAYS'),
            12 => array('city_name' => 'ALLAH ABAD', 'delivery_time' => '5-6 DAYS'),
            13 => array('city_name' => 'AMANGARH', 'delivery_time' => '6-7 DAYS'),
            14 => array('city_name' => 'ARIFWALA', 'delivery_time' => '3-4 DAYS'),
            15 => array('city_name' => 'ATTOCK', 'delivery_time' => '3-4 DAYS'),
            16 => array('city_name' => 'AYUBIA', 'delivery_time' => '6-7 DAYS'),
            17 => array('city_name' => 'BADIN', 'delivery_time' => '5-6 DAYS'),
            18 => array('city_name' => 'BADOMALI', 'delivery_time' => '5-6 DAYS'),
            19 => array('city_name' => 'BAFFA', 'delivery_time' => '6-7 DAYS'),
            20 => array('city_name' => 'BAGH', 'delivery_time' => '4-5 DAYS'),
            21 => array('city_name' => 'BAGHATANWALA', 'delivery_time' => '5-6 DAYS'),
            22 => array('city_name' => 'BAHAWALNAGAR', 'delivery_time' => '3-4 DAYS'),
            23 => array('city_name' => 'BAHAWALPUR', 'delivery_time' => '2-3 DAYS'),
            24 => array('city_name' => 'BAHTAR MORE', 'delivery_time' => '5-6 DAYS'),
            25 => array('city_name' => 'BAIG PUR', 'delivery_time' => '5-6 DAYS'),
            26 => array('city_name' => 'BALAM BUT', 'delivery_time' => '6-7 DAYS'),
            27 => array('city_name' => 'BANNU', 'delivery_time' => '6-7 DAYS'),
            28 => array('city_name' => 'BARA MARKET', 'delivery_time' => '6-7 DAYS'),
            29 => array('city_name' => 'BARAH KHU', 'delivery_time' => '5-6 DAYS'),
            30 => array('city_name' => 'BARI KOT', 'delivery_time' => '6-7 DAYS'),
            31 => array('city_name' => 'BASHARAT', 'delivery_time' => '5-6 DAYS'),
            32 => array('city_name' => 'BASIRPUR', 'delivery_time' => '5-6 DAYS'),
            33 => array('city_name' => 'BASTI MALOOK', 'delivery_time' => '5-6 DAYS'),
            34 => array('city_name' => 'BATGRAM', 'delivery_time' => '6-7 DAYS'),
            35 => array('city_name' => 'BATKHELA', 'delivery_time' => '6-7 DAYS'),
            36 => array('city_name' => 'BHAI PHERU', 'delivery_time' => '5-6 DAYS'),
            37 => array('city_name' => 'BHAKKAR', 'delivery_time' => '3-4 DAYS'),
            38 => array('city_name' => 'BHALWAAL', 'delivery_time' => '5-6 DAYS'),
            39 => array('city_name' => 'BHERA', 'delivery_time' => '5-6 DAYS'),
            40 => array('city_name' => 'BHIKKI', 'delivery_time' => '5-6 DAYS'),
            41 => array('city_name' => 'BHIMBER (AJK)', 'delivery_time' => '5-6 DAYS'),
            42 => array('city_name' => 'BHOWANA', 'delivery_time' => '5-6 DAYS'),
            43 => array('city_name' => 'BHURBUN (P.C. HOTEL)', 'delivery_time' => '5-6 DAYS'),
            44 => array('city_name' => 'BONGA HAYAT', 'delivery_time' => '5-6 DAYS'),
            45 => array('city_name' => 'BUCHEKE', 'delivery_time' => '5-6 DAYS'),
            46 => array('city_name' => 'BUNER', 'delivery_time' => '6-7 DAYS'),
            47 => array('city_name' => 'BUREWALA', 'delivery_time' => '3-4 DAYS'),
            48 => array('city_name' => 'CADET COLLEGE SUNNY BANK', 'delivery_time' => '5-6 DAYS'),
            49 => array('city_name' => 'CHAK JHUMRA', 'delivery_time' => '5-6 DAYS'),
            50 => array('city_name' => 'CHAK PARANA', 'delivery_time' => '5-6 DAYS'),
            51 => array('city_name' => 'CHAKDARA', 'delivery_time' => '6-7 DAYS'),
            52 => array('city_name' => 'CHAKLALA', 'delivery_time' => '5-6 DAYS'),
            53 => array('city_name' => 'CHAKRI', 'delivery_time' => '5-6 DAYS'),
            54 => array('city_name' => 'CHAKWAL', 'delivery_time' => '3-4 DAYS'),
            55 => array('city_name' => 'CHAMAN', 'delivery_time' => '6-7 DAYS'),
            56 => array('city_name' => 'CHANGA MANGA', 'delivery_time' => '5-6 DAYS'),
            57 => array('city_name' => 'CHAR BAGH', 'delivery_time' => '6-7 DAYS'),
            58 => array('city_name' => 'CHARSADDA', 'delivery_time' => '6-7 DAYS'),
            59 => array('city_name' => 'CHAWINDA', 'delivery_time' => '5-6 DAYS'),
            60 => array('city_name' => 'CHICHAWATNEE', 'delivery_time' => '3-4 DAYS'),
            61 => array('city_name' => 'CHINIOT', 'delivery_time' => '3-4 DAYS'),
            62 => array('city_name' => 'CHISTIAN', 'delivery_time' => '3-4 DAYS'),
            63 => array('city_name' => 'CHITRAL', 'delivery_time' => '5-6 DAYS'),
            64 => array('city_name' => 'CHOA SAIDAN SHAH', 'delivery_time' => '5-6 DAYS'),
            65 => array('city_name' => 'CHOBARA', 'delivery_time' => '5-6 DAYS'),
            66 => array('city_name' => 'CHOTA LAHORE', 'delivery_time' => '6-7 DAYS'),
            67 => array('city_name' => 'CHOWK AZAM', 'delivery_time' => '5-6 DAYS'),
            68 => array('city_name' => 'CHOWK PANDORI', 'delivery_time' => '5-6 DAYS'),
            69 => array('city_name' => 'CHUNIAN', 'delivery_time' => '5-6 DAYS'),
            70 => array('city_name' => 'DADU', 'delivery_time' => '5-6 DAYS'),
            71 => array('city_name' => 'DADYAL (AJK)', 'delivery_time' => '6-7 DAYS'),
            72 => array('city_name' => 'DAKWALA', 'delivery_time' => '5-6 DAYS'),
            73 => array('city_name' => 'DALBANDIN', 'delivery_time' => '6-7 DAYS'),
            74 => array('city_name' => 'DAOOD ZAI', 'delivery_time' => '6-7 DAYS'),
            75 => array('city_name' => 'DARGAI', 'delivery_time' => '6-7 DAYS'),
            76 => array('city_name' => 'DARYA KHAN', 'delivery_time' => '6-7 DAYS'),
            77 => array('city_name' => 'DASKA', 'delivery_time' => '3-4 DAYS'),
            78 => array('city_name' => 'DAUL TALA', 'delivery_time' => '5-6 DAYS'),
            79 => array('city_name' => 'DEHARKI', 'delivery_time' => '5-6 DAYS'),
            80 => array('city_name' => 'DEPALPUR', 'delivery_time' => '5-6 DAYS'),
            81 => array('city_name' => 'DERA ALLAH YAR', 'delivery_time' => '5-6 DAYS'),
            82 => array('city_name' => 'DERA GHAZI KHAN', 'delivery_time' => '3-4 DAYS'),
            83 => array('city_name' => 'DERA ISMAIL KHAN', 'delivery_time' => '3-4 DAYS'),
            84 => array('city_name' => 'DERA MURAD JAMALI', 'delivery_time' => '5-6 DAYS'),
            85 => array('city_name' => 'DERA NAWAB', 'delivery_time' => '5-6 DAYS'),
            86 => array('city_name' => 'DEWALAY', 'delivery_time' => '6-7 DAYS'),
            87 => array('city_name' => 'DHABJEE', 'delivery_time' => '5-6 DAYS'),
            88 => array('city_name' => 'DHUDIAL', 'delivery_time' => '5-6 DAYS'),
            89 => array('city_name' => 'DIGRI', 'delivery_time' => '5-6 DAYS'),
            90 => array('city_name' => 'DIJKOT', 'delivery_time' => '5-6 DAYS'),
            91 => array('city_name' => 'DINA', 'delivery_time' => '5-6 DAYS'),
            92 => array('city_name' => 'DINGA', 'delivery_time' => '5-6 DAYS'),
            93 => array('city_name' => 'DISTT. COMPLEX', 'delivery_time' => '5-6 DAYS'),
            94 => array('city_name' => 'DOABA', 'delivery_time' => '6-7 DAYS'),
            95 => array('city_name' => 'DOKRI', 'delivery_time' => '5-6 DAYS'),
            96 => array('city_name' => 'DONGA BONGA', 'delivery_time' => '5-6 DAYS'),
            97 => array('city_name' => 'DULLE WALA', 'delivery_time' => '6-7 DAYS'),
            98 => array('city_name' => 'DUNIAPUR', 'delivery_time' => '5-6 DAYS'),
            99 => array('city_name' => 'F.F.C. PLANT', 'delivery_time' => '5-6 DAYS'),
            100 => array('city_name' => 'FAISALABAD', 'delivery_time' => '2-3 DAYS'),
            101 => array('city_name' => 'FAQIRWALI', 'delivery_time' => '5-6 DAYS'),
            102 => array('city_name' => 'FAROKA', 'delivery_time' => '5-6 DAYS'),
            103 => array('city_name' => 'FAROOQABAD', 'delivery_time' => '5-6 DAYS'),
            104 => array('city_name' => 'FATEH JANG', 'delivery_time' => '5-6 DAYS'),
            105 => array('city_name' => 'FATEH PUR', 'delivery_time' => '5-6 DAYS'),
            106 => array('city_name' => 'FATEH PUR KAMAL', 'delivery_time' => '5-6 DAYS'),
            107 => array('city_name' => 'FAZIL PUR', 'delivery_time' => '5-6 DAYS'),
            108 => array('city_name' => 'FEROZ WATWAN', 'delivery_time' => '5-6 DAYS'),
            109 => array('city_name' => 'FKPCL POWER PLANT', 'delivery_time' => '5-6 DAYS'),
            110 => array('city_name' => 'FORT ABBAS', 'delivery_time' => '3-4 DAYS'),
            111 => array('city_name' => 'GAGGO MANDI', 'delivery_time' => '5-6 DAYS'),
            112 => array('city_name' => 'GAMBAT', 'delivery_time' => '5-6 DAYS'),
            113 => array('city_name' => 'GAMBER', 'delivery_time' => '5-6 DAYS'),
            114 => array('city_name' => 'GARHA MORE', 'delivery_time' => '5-6 DAYS'),
            115 => array('city_name' => 'GATWALA 199 / RB', 'delivery_time' => '5-6 DAYS'),
            116 => array('city_name' => 'GAWADER', 'delivery_time' => '6-7 DAYS'),
            117 => array('city_name' => 'GHAKKAR MANDI', 'delivery_time' => '5-6 DAYS'),
            118 => array('city_name' => 'GHARIBWAL CEMENT', 'delivery_time' => '5-6 DAYS'),
            119 => array('city_name' => 'GHARO', 'delivery_time' => '5-6 DAYS'),
            120 => array('city_name' => 'GHAZI', 'delivery_time' => '5-6 DAYS'),
            121 => array('city_name' => 'GHAZIABAD', 'delivery_time' => '5-6 DAYS'),
            122 => array('city_name' => 'GHIKA GALI', 'delivery_time' => '5-6 DAYS'),
            123 => array('city_name' => 'GHORA GALI', 'delivery_time' => '5-6 DAYS'),
            124 => array('city_name' => 'GHOTKI', 'delivery_time' => '5-6 DAYS'),
            125 => array('city_name' => 'GHOUR GHUSTI', 'delivery_time' => '5-6 DAYS'),
            126 => array('city_name' => 'GHOUS PUR', 'delivery_time' => '5-6 DAYS'),
            127 => array('city_name' => 'GILGIT', 'delivery_time' => '5-6 DAYS'),
            128 => array('city_name' => 'GOJRA', 'delivery_time' => '5-6 DAYS'),
            129 => array('city_name' => 'GOLARCHI', 'delivery_time' => '5-6 DAYS'),
            130 => array('city_name' => 'GOTH MACHI', 'delivery_time' => '5-6 DAYS'),
            131 => array('city_name' => 'GUJAR KHAN', 'delivery_time' => '4-5 DAYS'),
            132 => array('city_name' => 'GUJRANWALA', 'delivery_time' => '2-3 DAYS'),
            133 => array('city_name' => 'GUJRAT', 'delivery_time' => '3-4 DAYS'),
            134 => array('city_name' => 'GULYANA', 'delivery_time' => '5-6 DAYS'),
            135 => array('city_name' => 'HAFIZABAD', 'delivery_time' => '3-4 DAYS'),
            136 => array('city_name' => 'HAJEERA', 'delivery_time' => '6-7 DAYS'),
            137 => array('city_name' => 'HAKEEM ABAD', 'delivery_time' => '6-7 DAYS'),
            138 => array('city_name' => 'HALA', 'delivery_time' => '5-6 DAYS'),
            139 => array('city_name' => 'HANGU', 'delivery_time' => '6-7 DAYS'),
            140 => array('city_name' => 'HARAPPA', 'delivery_time' => '5-6 DAYS'),
            141 => array('city_name' => 'HARIPUR', 'delivery_time' => '4-5 DAYS'),
            142 => array('city_name' => 'HARNAL', 'delivery_time' => '5-6 DAYS'),
            143 => array('city_name' => 'HAROONABAD', 'delivery_time' => '3-4 DAYS'),
            144 => array('city_name' => 'HASANABDAAL', 'delivery_time' => '5-6 DAYS'),
            145 => array('city_name' => 'HASEEB WAQAS MILLS', 'delivery_time' => '5-6 DAYS'),
            146 => array('city_name' => 'HASIL PUR', 'delivery_time' => '5-6 DAYS'),
            147 => array('city_name' => 'HATIA BALA', 'delivery_time' => '6-7 DAYS'),
            148 => array('city_name' => 'HATTAR', 'delivery_time' => '6-7 DAYS'),
            149 => array('city_name' => 'HAVELI LAKHA', 'delivery_time' => '5-6 DAYS'),
            150 => array('city_name' => 'HAVELIAN', 'delivery_time' => '6-7 DAYS'),
            151 => array('city_name' => 'HAZARA UNIVERSITY', 'delivery_time' => '6-7 DAYS'),
            152 => array('city_name' => 'HAZRO', 'delivery_time' => '5-6 DAYS'),
            153 => array('city_name' => 'HEAD BALOKI ROAD', 'delivery_time' => '5-6 DAYS'),
            154 => array('city_name' => 'HEADMARALA', 'delivery_time' => '5-6 DAYS'),
            155 => array('city_name' => 'HUB CHOWKI', 'delivery_time' => '5-6 DAYS'),
            156 => array('city_name' => 'HUJRA SHAH MUKEEM', 'delivery_time' => '5-6 DAYS'),
            157 => array('city_name' => 'HUSRI', 'delivery_time' => '5-6 DAYS'),
            158 => array('city_name' => 'HYDERABAD', 'delivery_time' => '2-3 DAYS'),
            159 => array('city_name' => 'IQBAL ABAD', 'delivery_time' => '5-6 DAYS'),
            160 => array('city_name' => 'IQBAL NAGAR', 'delivery_time' => '5-6 DAYS'),
            161 => array('city_name' => 'ISLAMABAD', 'delivery_time' => '2-3 DAYS'),
            162 => array('city_name' => 'JACABABAD', 'delivery_time' => '5-6 DAYS'),
            163 => array('city_name' => 'JAFFARABAD', 'delivery_time' => '5-6 DAYS'),
            164 => array('city_name' => 'JAHANIAN', 'delivery_time' => '5-6 DAYS'),
            165 => array('city_name' => 'JALALPUR BHATTIAN', 'delivery_time' => '5-6 DAYS'),
            166 => array('city_name' => 'JALALPUR JATTAN', 'delivery_time' => '5-6 DAYS'),
            167 => array('city_name' => 'JALALPURPIRWALA', 'delivery_time' => '5-6 DAYS'),
            168 => array('city_name' => 'JAMPUR', 'delivery_time' => '5-6 DAYS'),
            169 => array('city_name' => 'JAMSHERO', 'delivery_time' => '5-6 DAYS'),
            170 => array('city_name' => 'JANDIA SHER KHAN', 'delivery_time' => '5-6 DAYS'),
            171 => array('city_name' => 'JARANWALA', 'delivery_time' => '3-4 DAYS'),
            172 => array('city_name' => 'JATOI', 'delivery_time' => '5-6 DAYS'),
            173 => array('city_name' => 'JEHANGIRA', 'delivery_time' => '6-7 DAYS'),
            174 => array('city_name' => 'JEHLUM', 'delivery_time' => '3-4 DAYS'),
            175 => array('city_name' => 'JHABRAN MANDI', 'delivery_time' => '5-6 DAYS'),
            176 => array('city_name' => 'JHANG', 'delivery_time' => '3-4 DAYS'),
            177 => array('city_name' => 'JOHARABAD', 'delivery_time' => '5-6 DAYS'),
            178 => array('city_name' => 'JOHI', 'delivery_time' => '5-6 DAYS'),
            179 => array('city_name' => 'KABIRWALA', 'delivery_time' => '5-6 DAYS'),
            180 => array('city_name' => 'KAHAUTA', 'delivery_time' => '5-6 DAYS'),
            181 => array('city_name' => 'KALAT', 'delivery_time' => '6-7 DAYS'),
            182 => array('city_name' => 'KALLAR KAHAR', 'delivery_time' => '5-6 DAYS'),
            183 => array('city_name' => 'KALLAR SYEDDAN', 'delivery_time' => '5-6 DAYS'),
            184 => array('city_name' => 'KALOR KOT', 'delivery_time' => '6-7 DAYS'),
            185 => array('city_name' => 'KAMALIA', 'delivery_time' => '3-4 DAYS'),
            186 => array('city_name' => 'KAMOKE', 'delivery_time' => '5-6 DAYS'),
            187 => array('city_name' => 'KAMRA', 'delivery_time' => '5-6 DAYS'),
            188 => array('city_name' => 'KAND KOT', 'delivery_time' => '5-6 DAYS'),
            189 => array('city_name' => 'KANDIARO', 'delivery_time' => '5-6 DAYS'),
            190 => array('city_name' => 'KANGAN PUR', 'delivery_time' => '5-6 DAYS'),
            191 => array('city_name' => 'KANGRA', 'delivery_time' => '6-7 DAYS'),
            192 => array('city_name' => 'KANJU', 'delivery_time' => '6-7 DAYS'),
            193 => array('city_name' => 'KANYAL', 'delivery_time' => '5-6 DAYS'),
            194 => array('city_name' => 'KAPCO POWER PLANT', 'delivery_time' => '5-6 DAYS'),
            195 => array('city_name' => 'KARACHI', 'delivery_time' => '1 Day'),
            196 => array('city_name' => 'KARAK', 'delivery_time' => '6-7 DAYS'),
            197 => array('city_name' => 'KARAM PUR', 'delivery_time' => '5-6 DAYS'),
            198 => array('city_name' => 'KAROOR PAKA', 'delivery_time' => '5-6 DAYS'),
            199 => array('city_name' => 'KAROR LAL EASAN', 'delivery_time' => '5-6 DAYS'),
            200 => array('city_name' => 'KASHMORE', 'delivery_time' => '5-6 DAYS'),
            201 => array('city_name' => 'KASSOWAL', 'delivery_time' => '5-6 DAYS'),
            202 => array('city_name' => 'KASUR', 'delivery_time' => '3-4 DAYS'),
            203 => array('city_name' => 'KHAIR PUR', 'delivery_time' => '5-6 DAYS'),
            204 => array('city_name' => 'KHAIRPUR MEERUS', 'delivery_time' => '5-6 DAYS'),
            205 => array('city_name' => 'KHAIRPUR TAMEWALI', 'delivery_time' => '5-6 DAYS'),
            206 => array('city_name' => 'KHAN GHAR', 'delivery_time' => '5-6 DAYS'),
            207 => array('city_name' => 'KHAN PUR', 'delivery_time' => '3-4 DAYS'),
            208 => array('city_name' => 'KHANEWAL', 'delivery_time' => '3-4 DAYS'),
            209 => array('city_name' => 'KHANKA DOGRAN', 'delivery_time' => '5-6 DAYS'),
            210 => array('city_name' => 'KHANPUR MAHAR', 'delivery_time' => '5-6 DAYS'),
            211 => array('city_name' => 'KHARIAN', 'delivery_time' => '5-6 DAYS'),
            212 => array('city_name' => 'KHAS BEHAAL', 'delivery_time' => '6-7 DAYS'),
            213 => array('city_name' => 'KHOAZA KHAILA', 'delivery_time' => '6-7 DAYS'),
            214 => array('city_name' => 'KHOSKI', 'delivery_time' => '5-6 DAYS'),
            215 => array('city_name' => 'KHUDIAN KHAS', 'delivery_time' => '5-6 DAYS'),
            216 => array('city_name' => 'KHURRIANWALA', 'delivery_time' => '5-6 DAYS'),
            217 => array('city_name' => 'KHUSHAAB', 'delivery_time' => '3-4 DAYS'),
            218 => array('city_name' => 'KHUZDAR', 'delivery_time' => '6-7 DAYS'),
            219 => array('city_name' => 'KHWERA', 'delivery_time' => '5-6 DAYS'),
            220 => array('city_name' => 'KOHAT', 'delivery_time' => '4-5 DAYS'),
            221 => array('city_name' => 'KOT ADDU', 'delivery_time' => '5-6 DAYS'),
            222 => array('city_name' => 'KOT CHUTTA', 'delivery_time' => '5-6 DAYS'),
            223 => array('city_name' => 'KOT MITHAN', 'delivery_time' => '5-6 DAYS'),
            224 => array('city_name' => 'KOT MOMIN', 'delivery_time' => '5-6 DAYS'),
            225 => array('city_name' => 'KOT PINDI DAS', 'delivery_time' => '5-6 DAYS'),
            226 => array('city_name' => 'KOT RADHA KISHAN', 'delivery_time' => '5-6 DAYS'),
            227 => array('city_name' => 'KOT SAMABAH', 'delivery_time' => '5-6 DAYS'),
            228 => array('city_name' => 'KOTLA ARAB ALI KHAN', 'delivery_time' => '5-6 DAYS'),
            229 => array('city_name' => 'KOTLI', 'delivery_time' => '4-5 DAYS'),
            230 => array('city_name' => 'KOTLI BEHRAM', 'delivery_time' => '5-6 DAYS'),
            231 => array('city_name' => 'KOTLI LOHARAN', 'delivery_time' => '5-6 DAYS'),
            232 => array('city_name' => 'KOTRI', 'delivery_time' => '5-6 DAYS'),
            233 => array('city_name' => 'KUCHLAK', 'delivery_time' => '6-7 DAYS'),
            234 => array('city_name' => 'KULACHI', 'delivery_time' => '6-7 DAYS'),
            235 => array('city_name' => 'KUNDIAN', 'delivery_time' => '5-6 DAYS'),
            236 => array('city_name' => 'KUNRI', 'delivery_time' => '5-6 DAYS'),
            237 => array('city_name' => 'LAHORE', 'delivery_time' => '2-3 DAYS'),
            238 => array('city_name' => 'LAKKI MARWAT', 'delivery_time' => '6-7 DAYS'),
            239 => array('city_name' => 'LALA MUSA', 'delivery_time' => '5-6 DAYS'),
            240 => array('city_name' => 'LALIAN', 'delivery_time' => '5-6 DAYS'),
            241 => array('city_name' => 'LALLIANI', 'delivery_time' => '5-6 DAYS'),
            242 => array('city_name' => 'LALPIR (THERMAL POWER)', 'delivery_time' => '5-6 DAYS'),
            243 => array('city_name' => 'LARKANA', 'delivery_time' => '3-4 DAYS'),
            244 => array('city_name' => 'LAWRENCE PUR', 'delivery_time' => '5-6 DAYS'),
            245 => array('city_name' => 'LAYYAH', 'delivery_time' => '3-4 DAYS'),
            246 => array('city_name' => 'LIAQAT PUR', 'delivery_time' => '5-6 DAYS'),
            247 => array('city_name' => 'LODHRAN', 'delivery_time' => '5-6 DAYS'),
            248 => array('city_name' => 'LORALAI', 'delivery_time' => '6-7 DAYS'),
            249 => array('city_name' => 'LOWER TOPA', 'delivery_time' => '5-6 DAYS'),
            250 => array('city_name' => 'MACHIKEY', 'delivery_time' => '5-6 DAYS'),
            251 => array('city_name' => 'MAILSI', 'delivery_time' => '5-6 DAYS'),
            252 => array('city_name' => 'MALAKAND', 'delivery_time' => '6-7 DAYS'),
            253 => array('city_name' => 'MALAKWAL', 'delivery_time' => '5-6 DAYS'),
            254 => array('city_name' => 'MANA WLA', 'delivery_time' => '5-6 DAYS'),
            255 => array('city_name' => 'MANAWALA', 'delivery_time' => '5-6 DAYS'),
            256 => array('city_name' => 'MANDI BAHAUDDIN', 'delivery_time' => '3-4 DAYS'),
            257 => array('city_name' => 'MANDI SAFDAR ABAD', 'delivery_time' => '5-6 DAYS'),
            258 => array('city_name' => 'MANDI USMAN WALA', 'delivery_time' => '5-6 DAYS'),
            259 => array('city_name' => 'MANDIAN', 'delivery_time' => '6-7 DAYS'),
            260 => array('city_name' => 'MANDRA', 'delivery_time' => '5-6 DAYS'),
            261 => array('city_name' => 'MANGA MANDI', 'delivery_time' => '5-6 DAYS'),
            262 => array('city_name' => 'MANGLA (AJK)', 'delivery_time' => '6-7 DAYS'),
            263 => array('city_name' => 'MANGLA CANTT (AJK)', 'delivery_time' => '6-7 DAYS'),
            264 => array('city_name' => 'MANKERA', 'delivery_time' => '6-7 DAYS'),
            265 => array('city_name' => 'MANKYLA STATION', 'delivery_time' => '5-6 DAYS'),
            266 => array('city_name' => 'MANSEHRA', 'delivery_time' => '4-5 DAYS'),
            267 => array('city_name' => 'MARDAN', 'delivery_time' => '4-5 DAYS'),
            268 => array('city_name' => 'MARI', 'delivery_time' => '5-6 DAYS'),
            269 => array('city_name' => 'MASAR CAMP', 'delivery_time' => '5-6 DAYS'),
            270 => array('city_name' => 'MASTUNG', 'delivery_time' => '6-7 DAYS'),
            271 => array('city_name' => 'MATIYARI', 'delivery_time' => '5-6 DAYS'),
            272 => array('city_name' => 'MATLI', 'delivery_time' => '5-6 DAYS'),
            273 => array('city_name' => 'MATTA', 'delivery_time' => '6-7 DAYS'),
            274 => array('city_name' => 'MEHER', 'delivery_time' => '5-6 DAYS'),
            275 => array('city_name' => 'MEHRAB PUR', 'delivery_time' => '5-6 DAYS'),
            276 => array('city_name' => 'MIAN CHANNU', 'delivery_time' => '3-4 DAYS'),
            277 => array('city_name' => 'MIAN WALI QURESHAIN', 'delivery_time' => '5-6 DAYS'),
            278 => array('city_name' => 'MIANI', 'delivery_time' => '5-6 DAYS'),
            279 => array('city_name' => 'MIANWALI', 'delivery_time' => '3-4 DAYS'),
            280 => array('city_name' => 'MINCHINABAD', 'delivery_time' => '5-6 DAYS'),
            281 => array('city_name' => 'MINGORA', 'delivery_time' => '6-7 DAYS'),
            282 => array('city_name' => 'MIR PUR KHAS', 'delivery_time' => '3-4 DAYS'),
            283 => array('city_name' => 'MIR PUR METHELO', 'delivery_time' => '5-6 DAYS'),
            284 => array('city_name' => 'MIRPUR (AJK)', 'delivery_time' => '4-5 DAYS'),
            285 => array('city_name' => 'MITHA TIWANA', 'delivery_time' => '5-6 DAYS'),
            286 => array('city_name' => 'MITTHI', 'delivery_time' => '5-6 DAYS'),
            287 => array('city_name' => 'MORE AIMANABAD', 'delivery_time' => '5-6 DAYS'),
            288 => array('city_name' => 'MORE KHUNDA', 'delivery_time' => '5-6 DAYS'),
            289 => array('city_name' => 'MORO', 'delivery_time' => '3-4 DAYS'),
            290 => array('city_name' => 'MOTRA', 'delivery_time' => '5-6 DAYS'),
            291 => array('city_name' => 'MUCH', 'delivery_time' => '6-7 DAYS'),
            292 => array('city_name' => 'MULTAN', 'delivery_time' => '2-3 DAYS'),
            293 => array('city_name' => 'MURIDKE', 'delivery_time' => '5-6 DAYS'),
            294 => array('city_name' => 'MURREE', 'delivery_time' => '4-5 DAYS'),
            295 => array('city_name' => 'MUZAFARABAD (AJK)', 'delivery_time' => '4-5 DAYS'),
            296 => array('city_name' => 'MUZAFFARGARH', 'delivery_time' => '3-4 DAYS'),
            297 => array('city_name' => 'NAROWAL', 'delivery_time' => '3-4 DAYS'),
            298 => array('city_name' => 'NAUSHKI', 'delivery_time' => '6-7 DAYS'),
            299 => array('city_name' => 'NAWAB SHAH', 'delivery_time' => '3-4 DAYS'),
            300 => array('city_name' => 'NAWAN SHEHR', 'delivery_time' => '6-7 DAYS'),
            301 => array('city_name' => 'NAWAY KALI', 'delivery_time' => '6-7 DAYS'),
            302 => array('city_name' => 'NEW INDUSTRIAL AREA', 'delivery_time' => '6-7 DAYS'),
            303 => array('city_name' => 'NIZAMABAD', 'delivery_time' => '5-6 DAYS'),
            304 => array('city_name' => 'NONAR', 'delivery_time' => '5-6 DAYS'),
            305 => array('city_name' => 'NOOR COLONY', 'delivery_time' => '6-7 DAYS'),
            306 => array('city_name' => 'NOOR KOT', 'delivery_time' => '5-6 DAYS'),
            307 => array('city_name' => 'NOORPUR', 'delivery_time' => '5-6 DAYS'),
            308 => array('city_name' => 'NOORPUR THAL', 'delivery_time' => '5-6 DAYS'),
            309 => array('city_name' => 'NORIABAD', 'delivery_time' => '5-6 DAYS'),
            310 => array('city_name' => 'NOWSHERA', 'delivery_time' => '6-7 DAYS'),
            311 => array('city_name' => 'NOWSHERA KALAN', 'delivery_time' => '6-7 DAYS'),
            312 => array('city_name' => 'NOWSHERA VIRKAN', 'delivery_time' => '5-6 DAYS'),
            313 => array('city_name' => 'NOWSHERO FEROZE', 'delivery_time' => '5-6 DAYS'),
            314 => array('city_name' => 'NRTC (TELECOM STAFF COLLEGE)', 'delivery_time' => '6-7 DAYS'),
            315 => array('city_name' => 'NUDEARO', 'delivery_time' => '5-6 DAYS'),
            316 => array('city_name' => 'NUNKANA SAB', 'delivery_time' => '3-4 DAYS'),
            317 => array('city_name' => 'OKARA', 'delivery_time' => '3-4 DAYS'),
            318 => array('city_name' => 'OLD HALA', 'delivery_time' => '5-6 DAYS'),
            319 => array('city_name' => 'P.O.F. (FACTORY & COLONY)', 'delivery_time' => '5-6 DAYS'),
            320 => array('city_name' => 'PABI', 'delivery_time' => '6-7 DAYS'),
            321 => array('city_name' => 'PAHARPUR', 'delivery_time' => '6-7 DAYS'),
            322 => array('city_name' => 'PAKPATTAN', 'delivery_time' => '3-4 DAYS'),
            323 => array('city_name' => 'PANOAQIL', 'delivery_time' => '5-6 DAYS'),
            324 => array('city_name' => 'PAROA', 'delivery_time' => '6-7 DAYS'),
            325 => array('city_name' => 'PASROOR', 'delivery_time' => '5-6 DAYS'),
            326 => array('city_name' => 'PASROOR ROAD AND VILLAGES', 'delivery_time' => '5-6 DAYS'),
            327 => array('city_name' => 'PATOKI', 'delivery_time' => '3-4 DAYS'),
            328 => array('city_name' => 'PATRIATA', 'delivery_time' => '5-6 DAYS'),
            329 => array('city_name' => 'PEER MAHAL', 'delivery_time' => '5-6 DAYS'),
            330 => array('city_name' => 'PESHAWAR', 'delivery_time' => '3-4 DAYS'),
            331 => array('city_name' => 'PEZU', 'delivery_time' => '6-7 DAYS'),
            332 => array('city_name' => 'PHALIA', 'delivery_time' => '5-6 DAYS'),
            333 => array('city_name' => 'PIND DADAN KHAN', 'delivery_time' => '5-6 DAYS'),
            334 => array('city_name' => 'PINDI BHATIAN', 'delivery_time' => '5-6 DAYS'),
            335 => array('city_name' => 'PINDI GHEB', 'delivery_time' => '5-6 DAYS'),
            336 => array('city_name' => 'PINDI GUJRAN', 'delivery_time' => '5-6 DAYS'),
            337 => array('city_name' => 'PIPLAN', 'delivery_time' => '5-6 DAYS'),
            338 => array('city_name' => 'PIR BABA', 'delivery_time' => '6-7 DAYS'),
            339 => array('city_name' => 'PISHIN', 'delivery_time' => '6-7 DAYS'),
            340 => array('city_name' => 'PITARO', 'delivery_time' => '5-6 DAYS'),
            341 => array('city_name' => 'PLANDARI / SADHNOTI (AJK)', 'delivery_time' => '5-6 DAYS'),
            342 => array('city_name' => 'PMA KAKUL', 'delivery_time' => '6-7 DAYS'),
            343 => array('city_name' => 'POONCH (AJK)', 'delivery_time' => '6-7 DAYS'),
            344 => array('city_name' => 'PUNGIRAYIN', 'delivery_time' => '6-7 DAYS'),
            345 => array('city_name' => 'PUNWAN', 'delivery_time' => '5-6 DAYS'),
            346 => array('city_name' => 'QABAL', 'delivery_time' => '6-7 DAYS'),
            347 => array('city_name' => 'QABOOLA SHARIF', 'delivery_time' => '5-6 DAYS'),
            348 => array('city_name' => 'QADIR PUR RAWAN', 'delivery_time' => '5-6 DAYS'),
            349 => array('city_name' => 'QAIDABAD', 'delivery_time' => '5-6 DAYS'),
            350 => array('city_name' => 'QAMAR MASHANI', 'delivery_time' => '5-6 DAYS'),
            351 => array('city_name' => 'QILA DEEDAR SING', 'delivery_time' => '5-6 DAYS'),
            352 => array('city_name' => 'QILA SAIB SINGH', 'delivery_time' => '5-6 DAYS'),
            353 => array('city_name' => 'QUETTA', 'delivery_time' => '3-4 DAYS'),
            354 => array('city_name' => 'RAHIM YAR KHAN', 'delivery_time' => '2-3 DAYS'),
            355 => array('city_name' => 'RAIWIND', 'delivery_time' => '5-6 DAYS'),
            356 => array('city_name' => 'RAJA JANG', 'delivery_time' => '5-6 DAYS'),
            357 => array('city_name' => 'RAJAN PUR', 'delivery_time' => '5-6 DAYS'),
            358 => array('city_name' => 'RAJANA', 'delivery_time' => '5-6 DAYS'),
            359 => array('city_name' => 'RAJAR', 'delivery_time' => '6-7 DAYS'),
            360 => array('city_name' => 'RAMAK', 'delivery_time' => '6-7 DAYS'),
            361 => array('city_name' => 'RANI PUR', 'delivery_time' => '5-6 DAYS'),
            362 => array('city_name' => 'RAO KHAN WALA', 'delivery_time' => '5-6 DAYS'),
            363 => array('city_name' => 'RATO DEARO', 'delivery_time' => '5-6 DAYS'),
            364 => array('city_name' => 'RAWALAKOT (AJK)', 'delivery_time' => '3-4 DAYS'),
            365 => array('city_name' => 'RAWALPINDI', 'delivery_time' => '2-3 DAYS'),
            366 => array('city_name' => 'RAWAT', 'delivery_time' => '5-6 DAYS'),
            367 => array('city_name' => 'RENALA KHURD', 'delivery_time' => '5-6 DAYS'),
            368 => array('city_name' => 'RISALPUR', 'delivery_time' => '6-7 DAYS'),
            369 => array('city_name' => 'ROHRI', 'delivery_time' => '5-6 DAYS'),
            370 => array('city_name' => 'RUBWA', 'delivery_time' => '5-6 DAYS'),
            371 => array('city_name' => 'SADIQABAD', 'delivery_time' => '3-4 DAYS'),
            372 => array('city_name' => 'SAFDARABAD', 'delivery_time' => '5-6 DAYS'),
            373 => array('city_name' => 'SAHIWAL', 'delivery_time' => '2-3 DAYS'),
            374 => array('city_name' => 'SAIDU SHARIF', 'delivery_time' => '6-7 DAYS'),
            375 => array('city_name' => 'SAJAWAL', 'delivery_time' => '5-6 DAYS'),
            376 => array('city_name' => 'SAKRAND', 'delivery_time' => '5-6 DAYS'),
            377 => array('city_name' => 'SAMANDARI', 'delivery_time' => '3-4 DAYS'),
            378 => array('city_name' => 'SANGAR', 'delivery_time' => '5-6 DAYS'),
            379 => array('city_name' => 'SANGLA HILL', 'delivery_time' => '5-6 DAYS'),
            380 => array('city_name' => 'SANJWAL', 'delivery_time' => '5-6 DAYS'),
            381 => array('city_name' => 'SARAYE NORANG', 'delivery_time' => '6-7 DAYS'),
            382 => array('city_name' => 'SARDAR GARH', 'delivery_time' => '5-6 DAYS'),
            383 => array('city_name' => 'SARDARYAB', 'delivery_time' => '6-7 DAYS'),
            384 => array('city_name' => 'SARGODHA', 'delivery_time' => '2-3 DAYS'),
            385 => array('city_name' => 'SARI ALAMGIR', 'delivery_time' => '5-6 DAYS'),
            386 => array('city_name' => 'SAWABI', 'delivery_time' => '6-7 DAYS'),
            387 => array('city_name' => 'SAWAT', 'delivery_time' => '4-5 DAYS'),
            388 => array('city_name' => 'SEHWAN SHARIF', 'delivery_time' => '5-6 DAYS'),
            389 => array('city_name' => 'SHABQADAR', 'delivery_time' => '6-7 DAYS'),
            390 => array('city_name' => 'SHADAD KOT', 'delivery_time' => '5-6 DAYS'),
            391 => array('city_name' => 'SHADIWAL', 'delivery_time' => '5-6 DAYS'),
            392 => array('city_name' => 'SHAH PUR CHAKAR', 'delivery_time' => '5-6 DAYS'),
            393 => array('city_name' => 'SHAHDAD PUR', 'delivery_time' => '5-6 DAYS'),
            394 => array('city_name' => 'SHAHKOT', 'delivery_time' => '5-6 DAYS'),
            395 => array('city_name' => 'SHAHPUR SADDAR', 'delivery_time' => '5-6 DAYS'),
            396 => array('city_name' => 'SHAKARGARH', 'delivery_time' => '5-6 DAYS'),
            397 => array('city_name' => 'SHAM KOT', 'delivery_time' => '5-6 DAYS'),
            398 => array('city_name' => 'SHAMS ABAD', 'delivery_time' => '5-6 DAYS'),
            399 => array('city_name' => 'SHANGLA', 'delivery_time' => '6-7 DAYS'),
            400 => array('city_name' => 'SHEEDO', 'delivery_time' => '6-7 DAYS'),
            401 => array('city_name' => 'SHEIKHUPURA', 'delivery_time' => '2-3 DAYS'),
            402 => array('city_name' => 'SHERGARH', 'delivery_time' => '6-7 DAYS'),
            403 => array('city_name' => 'SHEWA ADDA', 'delivery_time' => '6-7 DAYS'),
            404 => array('city_name' => 'SHIKARPUR', 'delivery_time' => '5-6 DAYS'),
            405 => array('city_name' => 'SHIMLA HILL', 'delivery_time' => '6-7 DAYS'),
            406 => array('city_name' => 'SHORKOT', 'delivery_time' => '5-6 DAYS'),
            407 => array('city_name' => 'SHUJABAD', 'delivery_time' => '5-6 DAYS'),
            408 => array('city_name' => 'SIALKOT', 'delivery_time' => '2-3 DAYS'),
            409 => array('city_name' => 'SIBI', 'delivery_time' => '5-6 DAYS'),
            410 => array('city_name' => 'SIHALA', 'delivery_time' => '5-6 DAYS'),
            411 => array('city_name' => 'SIKANDARABAD', 'delivery_time' => '5-6 DAYS'),
            412 => array('city_name' => 'SILANWALI', 'delivery_time' => '5-6 DAYS'),
            413 => array('city_name' => 'SIRAYE MUHAJIR', 'delivery_time' => '6-7 DAYS'),
            414 => array('city_name' => 'SKARDU', 'delivery_time' => '5-6 DAYS'),
            415 => array('city_name' => 'SMAAL IND ESTATE. DASKA', 'delivery_time' => '5-6 DAYS'),
            416 => array('city_name' => 'SOHAWA ONLY MAIN GT ROAD', 'delivery_time' => '5-6 DAYS'),
            417 => array('city_name' => 'SUKKUR', 'delivery_time' => '2-3 DAYS'),
            418 => array('city_name' => 'SUMBRIAL', 'delivery_time' => '5-6 DAYS'),
            419 => array('city_name' => 'SUNDER ADDA', 'delivery_time' => '5-6 DAYS'),
            420 => array('city_name' => 'SWABI', 'delivery_time' => '6-7 DAYS'),
            421 => array('city_name' => 'SYED WALA', 'delivery_time' => '5-6 DAYS'),
            422 => array('city_name' => 'TAKHT-E-BHAI', 'delivery_time' => '6-7 DAYS'),
            423 => array('city_name' => 'TALAGUNG', 'delivery_time' => '5-6 DAYS'),
            424 => array('city_name' => 'TALHAR', 'delivery_time' => '5-6 DAYS'),
            425 => array('city_name' => 'TALVANDI', 'delivery_time' => '5-6 DAYS'),
            426 => array('city_name' => 'TANDLAWALA', 'delivery_time' => '5-6 DAYS'),
            427 => array('city_name' => 'TANDO ADAM', 'delivery_time' => '5-6 DAYS'),
            428 => array('city_name' => 'TANDO ALLAHYAR', 'delivery_time' => '5-6 DAYS'),
            429 => array('city_name' => 'TANDO GHULAM ALI', 'delivery_time' => '5-6 DAYS'),
            430 => array('city_name' => 'TANDO JAM', 'delivery_time' => '5-6 DAYS'),
            431 => array('city_name' => 'TANDO JAN MUHAMMAD', 'delivery_time' => '5-6 DAYS'),
            432 => array('city_name' => 'TANDO MOHD KHAN', 'delivery_time' => '5-6 DAYS'),
            433 => array('city_name' => 'TANGI', 'delivery_time' => '6-7 DAYS'),
            434 => array('city_name' => 'TANK', 'delivery_time' => '6-7 DAYS'),
            435 => array('city_name' => 'TARBELA DAM', 'delivery_time' => '6-7 DAYS'),
            436 => array('city_name' => 'TARNOL', 'delivery_time' => '5-6 DAYS'),
            437 => array('city_name' => 'TAUNSA SHARIF', 'delivery_time' => '5-6 DAYS'),
            438 => array('city_name' => 'TAXLA', 'delivery_time' => '4-5 DAYS'),
            439 => array('city_name' => 'THATTA', 'delivery_time' => '4-5 DAYS'),
            440 => array('city_name' => 'THEENG MORE (ALLAHABAD)', 'delivery_time' => '5-6 DAYS'),
            441 => array('city_name' => 'THULL', 'delivery_time' => '5-6 DAYS'),
            442 => array('city_name' => 'TIBBA SULTANPURA', 'delivery_time' => '5-6 DAYS'),
            443 => array('city_name' => 'TIMARGARAH', 'delivery_time' => '6-7 DAYS'),
            444 => array('city_name' => 'TOBA TEK SINGH', 'delivery_time' => '3-4 DAYS'),
            445 => array('city_name' => 'TOPI (GIK UNIVERSITY AREA ONLY)*', 'delivery_time' => '6-7 DAYS'),
            446 => array('city_name' => 'TRANDA SAWAY KHAN', 'delivery_time' => '5-6 DAYS'),
            447 => array('city_name' => 'TURBAT', 'delivery_time' => '6-7 DAYS'),
            448 => array('city_name' => 'UBARO', 'delivery_time' => '5-6 DAYS'),
            449 => array('city_name' => 'UCH SHRIF', 'delivery_time' => '5-6 DAYS'),
            450 => array('city_name' => 'UGGOKE', 'delivery_time' => '5-6 DAYS'),
            451 => array('city_name' => 'UMER KOT', 'delivery_time' => '5-6 DAYS'),
            452 => array('city_name' => 'UPPER DIR', 'delivery_time' => '6-7 DAYS'),
            453 => array('city_name' => 'USTA MUHAMMAD', 'delivery_time' => '5-6 DAYS'),
            454 => array('city_name' => 'VEHARI', 'delivery_time' => '3-4 DAYS'),
            455 => array('city_name' => 'VILLAGE SIAL', 'delivery_time' => '6-7 DAYS'),
            456 => array('city_name' => 'WAH CANTT', 'delivery_time' => '4-5 DAYS'),
            457 => array('city_name' => 'WAN RAHDA RAM', 'delivery_time' => '5-6 DAYS'),
            458 => array('city_name' => 'WAPDA COLONY (AJK)', 'delivery_time' => '6-7 DAYS'),
            459 => array('city_name' => 'WARBATTAN', 'delivery_time' => '5-6 DAYS'),
            460 => array('city_name' => 'WAZIRABAD', 'delivery_time' => '3-4 DAYS'),
            461 => array('city_name' => 'YAZMAN', 'delivery_time' => '5-6 DAYS'),
            462 => array('city_name' => 'ZAFARWAL', 'delivery_time' => '5-6 DAYS'),
            463 => array('city_name' => 'ZAHIR PIR', 'delivery_time' => '5-6 DAYS'),
            464 => array('city_name' => 'ZHOB', 'delivery_time' => '6-7 DAYS'),
        );

        array_filter($cities, function (){

        });

        $cc=0;
        foreach ($cities as $key=>$val){
            //$cc++;
            //echo $cc . "\n";
            //echo 'city' . $val['city_name']. "\n";
            //echo 'delivery' . $val['delivery_time']. "\n";

        }

        return '';

        $data = User::with(['originality','role'=>function($query){
            //  return $query->where('name', 'customer');
        }])->where('role_id', '=',3)->get();
        echo "<pre>";

        print_r($data->toArray());
        echo "</pre>";

        return base_path('../temp/');
       // $parcel = new Parcel();
       // echo $parcel->generateParcelNumber();

//        return  "general found true";

        //return env('APP_URL').'/storage';
        //return public_path('storage');
        return storage_path('app/public');
        return storage_path('app/public');
        return  base_path();
        if(File::isDirectory(base_path('users_bills'))){
            return base_path('users_bills\\' . 'filename');
        }

    }

    public function getUserRole(){
        if(Auth::check()){
            dd(Auth::user()->toArray());
        }
        return 0;
    }

    public function getFile($filename)
	{
		return response()->download(base_path('users_bills\\' . $filename), null, [], null);
	}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        //
    }
}
