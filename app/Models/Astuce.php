<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Astuce extends Model
{
    use HasFactory;

    public function getStaticData($type)
    {
        return StaticData::where("type", $type)
            ->where("entreprise_id", Auth::user()->entreprise_id)
            ->where("statut", 1)
            ->get();
    }

    public function addHistorique($description, $type)
    {
        Historique::create([
            'description' => $description,
            'type' => $type,
            'user_id' => Auth::user()->id,
            'date' => new DateTime(),
        ]);
    }

    public function createFirstSuperAdmin()
    {
        $countUser = User::count();

        if($countUser < 1){
            User::create([
                'nom'=>"Niang",
                'prenom'=>"Bassirou",
                'role'=>"Super Admin",
                'email'=>"NiangProgrammeur@gmail.com",
                'tel'=>"783123657",
                'sexe'=>"Homme",
                'profil' => "user-male.png",
                'entreprise_id'=>null,
                'password'=>'$2y$10$rAVZ/DGGDV5KooV1NqJ48Om35GkkYcqFd/lAkehgzA3.D5A5YcrtC',
            ]);
        }
    }

    public function superAdmins()
    {
        return User::where('role', 'Super Admin')->orderBy('prenom', 'ASC')->paginate(8);
    }

    public function admins()
    {
        return User::where('role', 'Admin')->orderBy('id', 'DESC')->paginate(8);
    }

    public function commercials()
    {
        return User::where('role', 'Commercial')->orderBy('id', 'DESC')->paginate(3);
    }

    public function comptables()
    {
        return User::where('role', 'Comptable')->orderBy('id', 'DESC')->paginate(3);
    }

    public function entreprises()
    {
        return Entreprise::orderBy('nom', 'ASC')->get();
    }

    public function employes()
    {
        return User::where('role', "Employe")->orderBy("Prenom", "ASC")->get();
    }

    public function superAdminHistorique()
    {
        $data = [];

        $users = User::orderBy('prenom', 'ASC')->get();

        foreach ($users as $user) {
            if ($user->role === "Super Admin") {
                foreach ($user->historiques as $histo) {
                    $data[] = $histo;
                }
            }
        }

        return $data;
    }

    public function adminHistorique()
    {
        $data = [];

        $users = User::orderBy('prenom', 'ASC')->get();

        foreach ($users as $user) {
            if ($user->role !== "Super Admin" && $user->entreprise_id === Auth::user()->entreprise_id) {
                foreach ($user->historiques as $histo) {
                    $data[] = $histo;
                }
            }
        }

        return $data;
    }


    public function initStaticData()
    {
        $tab =[
            ['Type de fonction', 'Community Manager'],
            ['Type de d??pense', 'Facture Sen eau'],
            ['Type de d??pense', 'Facture Senelec'],
            ['Source du prospect', 'R??seaux sociaux'],
            ['Source du prospect', 'Courriers et appels'],
            ['Source du prospect', 'Site Web'],
            ['Source du prospect', 'Visite bureau'],
            ['Source du prospect', 'Autres'],
            ['Statut du prospect', 'Nouveau'],
            ['Statut du prospect', 'Proposition'],
            ['Statut du prospect', 'En cours'],
            ['Statut du prospect', 'Complet'],
            ['Mode de paiement', 'En esp??ces'],
            ['Mode de paiement', 'Ch??que'],
            ['Mode de paiement', 'Orange Money'],
            ['Mode de paiement', 'Wave'],
            ['Type des produits et services', 'Produit'],
            ['Type des produits et services', 'Service'],
            ['Statut des devis', 'Envoy??'],
            ['Statut des devis', 'Valid??'],
            ['Statut des devis', 'Brouillon'],
            ['Priorit?? des t??ches', 'Haute'],
            ['Priorit?? des t??ches', 'Moyen'],
            ['Priorit?? des t??ches', 'Faible'],
            ['Priorit?? des t??ches', 'Urgent'],
            ['Priorit?? des t??ches', 'Aucun'],
            ['Statut de la t??che', 'En attente'],
            ['Statut de la t??che', 'En cours'],
            ['Statut de la t??che', 'Termin??'],
            ['TVA', '0'],
            ['TVA', '18'],

        ];

        $last = Entreprise::orderBy('id', 'DESC')->first();

        foreach ($tab as $sds) {
            StaticData::create([
                    'type' => $sds[0],
                    'valeur' => $sds[1],
                    'entreprise_id' => $last->id,
                ]);
        }
    }

    public function initCountries()
    {
        $countPays = Country::count();
        if($countPays === 0){
            $pays = [
                ['AF', 'AFG', 'Afghanistan', 'Afghanistan'],
                ['AL', 'ALB', 'Albania', 'Albanie'],
                ['AQ', 'ATA', 'Antarctica', 'Antarctique'],
                ['DZ', 'DZA', 'Algeria', 'Alg??rie'],
                ['AS', 'ASM', 'American Samoa', 'Samoa Am??ricaines'],
                ['AD', "AND", 'Andorra', 'Andorre'],
                ['AO', 'AGO', 'Angola', 'Angola'],
                ['AG', 'ATG', 'Antigua and Barbuda', 'Antigua-et-Barbuda'],
                ['AZ', 'AZE', 'Azerbaijan', 'Azerba??djan'],
                [ 'AR', 'ARG', 'Argentina', 'Argentine'],
                [ 'AU', 'AUS', 'Australia', 'Australie'],
                [ 'AT', 'AUT', 'Austria', 'Autriche'],
                [ 'BS', 'BHS', 'Bahamas', 'Bahamas'],
                [ 'BH', 'BHR', 'Bahrain', 'Bahre??n'],
                [ 'BD', 'BGD', 'Bangladesh', 'Bangladesh'],
                [ 'AM', 'ARM', 'Armenia', 'Arm??nie'],
                [ 'BB', 'BRB', 'Barbados', 'Barbade'],
                [ 'BE', 'BEL', 'Belgium', 'Belgique'],
                [ 'BM', 'BMU', 'Bermuda', 'Bermudes'],
                [ 'BT', 'BTN', 'Bhutan', 'Bhoutan'],
                [ 'BO', 'BOL', 'Bolivia', 'Bolivie'],
                [ 'BA', 'BIH', 'Bosnia and Herzegovina', 'Bosnie-Herz??govine'],
                [ 'BW', 'BWA', 'Botswana', 'Botswana'],
                ['BV', 'BVT', 'Bouvet Island', '??le Bouvet'],
                ['BR', 'BRA', 'Brazil', 'Br??sil'],
                ['BZ', 'BLZ', 'Belize', 'Belize'],
                ['IO', 'IOT', 'British Indian Ocean Territory', 'Territoire Britannique de l\'Oc??an Indien'],
                ['SB', 'SLB', 'Solomon Islands', '??les Salomon'],
                ['VG', 'VGB', 'British Virgin Islands', '??les Vierges Britanniques'],
                ['BN', 'BRN', 'Brunei Darussalam', 'Brun??i Darussalam'],
                ['BG', 'BGR', 'Bulgaria', 'Bulgarie'],
                ['MM', 'MMR', 'Myanmar', 'Myanmar'],
                ['BI', 'BDI', 'Burundi', 'Burundi'],
                ['BY', 'BLR', 'Belarus', 'B??larus'],
                ['KH', 'KHM', 'Cambodia', 'Cambodge'],
                ['CM', 'CMR', 'Cameroon', 'Cameroun'],
                ['CA', 'CAN', 'Canada', 'Canada'],
                ['CV', 'CPV', 'Cape Verde', 'Cap-vert'],
                ['KY', 'CYM', 'Cayman Islands', '??les Ca??manes'],
                ['CF', 'CAF', 'Central African', 'R??publique Centrafricaine'],
                ['LK', 'LKA', 'Sri Lanka', 'Sri Lanka'],
                ['TD', 'TCD', 'Chad', 'Tchad'],
                ['CL', 'CHL', 'Chile', 'Chili'],
                ['CN', 'CHN', 'China', 'Chine'],
                ['TW', 'TWN', 'Taiwan', 'Ta??wan'],
                ['CX', 'CXR', 'Christmas Island', '??le Christmas'],
                ['CC', 'CCK', 'Cocos (Keeling) Islands', '??les Cocos (Keeling)'],
                ['CO', 'COL', 'Colombia', 'Colombie'],
                ['KM', 'COM', 'Comoros', 'Comores'],
                ['YT', 'MYT', 'Mayotte', 'Mayotte'],
                ['CG', 'COG', 'Republic of the Congo', 'R??publique du Congo'],
                ['CD', 'COD', 'The Democratic Republic Of The Congo', 'R??publique D??mocratique du Congo'],
                ['CK', 'COK', 'Cook Islands', '??les Cook'],
                ['CR', 'CRI', 'Costa Rica', 'Costa Rica'],
                ['HR', 'HRV', 'Croatia', 'Croatie'],
                ['CU', 'CUB', 'Cuba', 'Cuba'],
                ['CY', 'CYP', 'Cyprus', 'Chypre'],
                ['CZ', 'CZE', 'Czech Republic', 'R??publique Tch??que'],
                ['BJ', 'BEN', 'Benin', 'B??nin'],
                ['DK', 'DNK', 'Denmark', 'Danemark'],
                ['DM', 'DMA', 'Dominica', 'Dominique'],
                ['DO', 'DOM', 'Dominican Republic', 'R??publique Dominicaine'],
                ['EC', 'ECU', 'Ecuador', '??quateur'],
                ['SV', 'SLV', 'El Salvador', 'El Salvador'],
                ['GQ', 'GNQ', 'Equatorial Guinea', 'Guin??e ??quatoriale'],
                ['ET', 'ETH', 'Ethiopia', '??thiopie'],
                ['ER', 'ERI', 'Eritrea', '??rythr??e'],
                ['EE', 'EST', 'Estonia', 'Estonie'],
                ['FO', 'FRO', 'Faroe Islands', '??les F??ro??'],
                ['FK', 'FLK', 'Falkland Islands', '??les (malvinas) Falkland'],
                ['GS', 'SGS', 'South Georgia and the South Sandwich Islands', 'G??orgie du Sud et les ??les Sandwich du Sud'],
                ['FJ', 'FJI', 'Fiji', 'Fidji'],
                ['FI', 'FIN', 'Finland', 'Finlande'],
                ['AX', 'ALA', '??land Islands', '??les ??land'],
                ['FR', 'FRA', 'France', 'France'],
                ['GF', 'GUF', 'French Guiana', 'Guyane Fran??aise'],
                ['PF', 'PYF', 'French Polynesia', 'Polyn??sie Fran??aise'],
                ['TF', 'ATF', 'French Southern Territories', 'Terres Australes Fran??aises'],
                ['DJ', 'DJI', 'Djibouti', 'Djibouti'],
                ['GA', 'GAB', 'Gabon', 'Gabon'],
                ['GE', 'GEO', 'Georgia', 'G??orgie'],
                ['GM', 'GMB', 'Gambia', 'Gambie'],
                ['PS', 'PSE', 'Occupied Palestinian Territory', 'Territoire Palestinien Occup??'],
                ['DE', 'DEU', 'Germany', 'Allemagne'],
                ['GH', 'GHA', 'Ghana', 'Ghana'],
                ['GI', 'GIB', 'Gibraltar', 'Gibraltar'],
                ['KI', 'KIR', 'Kiribati', 'Kiribati'],
                ['GR', 'GRC', 'Greece', 'Gr??ce'],
                ['GL', 'GRL', 'Greenland', 'Groenland'],
                ['GD', 'GRD', 'Grenada', 'Grenade'],
                ['GP', 'GLP', 'Guadeloupe', 'Guadeloupe'],
                ['GU', 'GUM', 'Guam', 'Guam'],
                ['GT', 'GTM', 'Guatemala', 'Guatemala'],
                ['GN', 'GIN', 'Guinea', 'Guin??e'],
                ['GY', 'GUY', 'Guyana', 'Guyana'],
                ['HT', 'HTI', 'Haiti', 'Ha??ti'],
                ['HM', 'HMD', 'Heard Island and McDonald Islands', '??les Heard et Mcdonald'],
                ['VA', 'VAT', 'Vatican City State', 'Saint-Si??ge (??tat de la Cit?? du Vatican)'],
                ['HN', 'HND', 'Honduras', 'Honduras'],
                ['HK', 'HKG', 'Hong Kong', 'Hong-Kong'],
                ['HU', 'HUN', 'Hungary', 'Hongrie'],
                ['IS', 'ISL', 'Iceland', 'Islande'],
                ['IN', 'IND', 'India', 'Inde'],
                ['ID', 'IDN', 'Indonesia', 'Indon??sie'],
                ['IR', 'IRN', 'Islamic Republic of Iran', 'R??publique Islamique d\'Iran'],
                ['IQ', 'IRQ', 'Iraq', 'Iraq'],
                ['IE', 'IRL', 'Ireland', 'Irlande'],
                ['IL', 'ISR', 'Israel', 'Isra??l'],
                ['IT', 'ITA', 'Italy', 'Italie'],
                ['CI', 'CIV', 'C??te d\'Ivoire', 'C??te d\'Ivoire'],
                ['JM', 'JAM', 'Jamaica', 'Jama??que'],
                ['JP', 'JPN', 'Japan', 'Japon'],
                ['KZ', 'KAZ', 'Kazakhstan', 'Kazakhstan'],
                ['JO', 'JOR', 'Jordan', 'Jordanie'],
                ['KE', 'KEN', 'Kenya', 'Kenya'],
                ['KP', 'PRK', 'Democratic People\'s Republic of Korea', 'R??publique Populaire D??mocratique de Cor??e'],
                ['KR', 'KOR', 'Republic of Korea', 'R??publique de Cor??e'],
                ['KW', 'KWT', 'Kuwait', 'Kowe??t'],
                ['KG', 'KGZ', 'Kyrgyzstan', 'Kirghizistan'],
                ['LA', 'LAO', 'Lao People\'s Democratic Republic', 'R??publique D??mocratique Populaire Lao'],
                ['LB', 'LBN', 'Lebanon', 'Liban'],
                ['LS', 'LSO', 'Lesotho', 'Lesotho'],
                ['LV', 'LVA', 'Latvia', 'Lettonie'],
                ['LR', 'LBR', 'Liberia', 'Lib??ria'],
                ['LY', 'LBY', 'Libyan Arab Jamahiriya', 'Jamahiriya Arabe Libyenne'],
                ['LI', 'LIE', 'Liechtenstein', 'Liechtenstein'],
                ['LT', 'LTU', 'Lithuania', 'Lituanie'],
                ['LU', 'LUX', 'Luxembourg', 'Luxembourg'],
                ['MO', 'MAC', 'Macao', 'Macao'],
                ['MG', 'MDG', 'Madagascar', 'Madagascar'],
                ['MW', 'MWI', 'Malawi', 'Malawi'],
                ['MY', 'MYS', 'Malaysia', 'Malaisie'],
                ['MV', 'MDV', 'Maldives', 'Maldives'],
                ['ML', 'MLI', 'Mali', 'Mali'],
                ['MT', 'MLT', 'Malta', 'Malte'],
                ['MQ', 'MTQ', 'Martinique', 'Martinique'],
                ['MR', 'MRT', 'Mauritania', 'Mauritanie'],
                ['MU', 'MUS', 'Mauritius', 'Maurice'],
                ['MX', 'MEX', 'Mexico', 'Mexique'],
                ['MC', 'MCO', 'Monaco', 'Monaco'],
                ['MN', 'MNG', 'Mongolia', 'Mongolie'],
                ['MD', 'MDA', 'Republic of Moldova', 'R??publique de Moldova'],
                ['MS', 'MSR', 'Montserrat', 'Montserrat'],
                ['MA', 'MAR', 'Morocco', 'Maroc'],
                ['MZ', 'MOZ', 'Mozambique', 'Mozambique'],
                ['OM', 'OMN', 'Oman', 'Oman'],
                ['NA', 'NAM', 'Namibia', 'Namibie'],
                ['NR', 'NRU', 'Nauru', 'Nauru'],
                ['NP', 'NPL', 'Nepal', 'N??pal'],
                ['NL', 'NLD', 'Netherlands', 'Pays-Bas'],
                ['AN', 'ANT', 'Netherlands Antilles', 'Antilles N??erlandaises'],
                ['AW', 'ABW', 'Aruba', 'Aruba'],
                ['NC', 'NCL', 'New Caledonia', 'Nouvelle-Cal??donie'],
                ['VU', 'VUT', 'Vanuatu', 'Vanuatu'],
                ['NZ', 'NZL', 'New Zealand', 'Nouvelle-Z??lande'],
                ['NI', 'NIC', 'Nicaragua', 'Nicaragua'],
                ['NE', 'NER', 'Niger', 'Niger'],
                ['NG', 'NGA', 'Nigeria', 'Nig??ria'],
                ['NU', 'NIU', 'Niue', 'Niu??'],
                ['NF', 'NFK', 'Norfolk Island', '??le Norfolk'],
                ['NO', 'NOR', 'Norway', 'Norv??ge'],
                ['MP', 'MNP', 'Northern Mariana Islands', '??les Mariannes du Nord'],
                ['UM', 'UMI', 'United States Minor Outlying Islands', '??les Mineures ??loign??es des ??tats-Unis'],
                ['FM', 'FSM', 'Federated States of Micronesia', '??tats F??d??r??s de Micron??sie'],
                ['MH', 'MHL', 'Marshall Islands', '??les Marshall'],
                ['PW', 'PLW', 'Palau', 'Palaos'],
                ['PK', 'PAK', 'Pakistan', 'Pakistan'],
                ['PA', 'PAN', 'Panama', 'Panama'],
                ['PG', 'PNG', 'Papua New Guinea', 'Papouasie-Nouvelle-Guin??e'],
                ['PY', 'PRY', 'Paraguay', 'Paraguay'],
                ['PE', 'PER', 'Peru', 'P??rou'],
                ['PH', 'PHL', 'Philippines', 'Philippines'],
                ['PN', 'PCN', 'Pitcairn', 'Pitcairn'],
                ['PL', 'POL', 'Poland', 'Pologne'],
                ['PT', 'PRT', 'Portugal', 'Portugal'],
                ['GW', 'GNB', 'Guinea-Bissau', 'Guin??e-Bissau'],
                ['TL', 'TLS', 'Timor-Leste', 'Timor-Leste'],
                ['PR', 'PRI', 'Puerto Rico', 'Porto Rico'],
                ['QA', 'QAT', 'Qatar', 'Qatar'],
                ['RE', 'REU', 'R??union', 'R??union'],
                ['RO', 'ROU', 'Romania', 'Roumanie'],
                ['RU', 'RUS', 'Russian Federation', 'F??d??ration de Russie'],
                ['RW', 'RWA', 'Rwanda', 'Rwanda'],
                ['SH', 'SHN', 'Saint Helena', 'Sainte-H??l??ne'],
                ['KN', 'KNA', 'Saint Kitts and Nevis', 'Saint-Kitts-et-Nevis'],
                ['AI', 'AIA', 'Anguilla', 'Anguilla'],
                ['LC', 'LCA', 'Saint Lucia', 'Sainte-Lucie'],
                ['PM', 'SPM', 'Saint-Pierre and Miquelon', 'Saint-Pierre-et-Miquelon'],
                ['VC', 'VCT', 'Saint Vincent and the Grenadines', 'Saint-Vincent-et-les Grenadines'],
                ['SM', 'SMR', 'San Marino', 'Saint-Marin'],
                ['ST', 'STP', 'Sao Tome and Principe', 'Sao Tom??-et-Principe'],
                ['SA', 'SAU', 'Saudi Arabia', 'Arabie Saoudite'],
                ['SN', 'SEN', 'Senegal', 'S??n??gal'],
                ['SC', 'SYC', 'Seychelles', 'Seychelles'],
                ['SL', 'SLE', 'Sierra Leone', 'Sierra Leone'],
                ['SG', 'SGP', 'Singapore', 'Singapour'],
                ['SK', 'SVK', 'Slovakia', 'Slovaquie'],
                ['VN', 'VNM', 'Vietnam', 'Viet Nam'],
                ['SI', 'SVN', 'Slovenia', 'Slov??nie'],
                ['SO', 'SOM', 'Somalia', 'Somalie'],
                ['ZA', 'ZAF', 'South Africa', 'Afrique du Sud'],
                ['ZW', 'ZWE', 'Zimbabwe', 'Zimbabwe'],
                ['ES', 'ESP', 'Spain', 'Espagne'],
                ['EH', 'ESH', 'Western Sahara', 'Sahara Occidental'],
                ['SD', 'SDN', 'Sudan', 'Soudan'],
                ['SR', 'SUR', 'Suriname', 'Suriname'],
                ['SJ', 'SJM', 'Svalbard and Jan Mayen', 'Svalbard et??le Jan Mayen'],
                ['SZ', 'SWZ', 'Swaziland', 'Swaziland'],
                ['SE', 'SWE', 'Sweden', 'Su??de'],
                ['CH', 'CHE', 'Switzerland', 'Suisse'],
                ['SY', 'SYR', 'Syrian Arab Republic', 'R??publique Arabe Syrienne'],
                ['TJ', 'TJK', 'Tajikistan', 'Tadjikistan'],
                ['TH', 'THA', 'Thailand', 'Tha??lande'],
                ['TG', 'TGO', 'Togo', 'Togo'],
                ['TK', 'TKL', 'Tokelau', 'Tokelau'],
                ['TO', 'TON', 'Tonga', 'Tonga'],
                ['TT', 'TTO', 'Trinidad and Tobago', 'Trinit??-et-Tobago'],
                ['AE', 'ARE', 'United Arab Emirates', '??mirats Arabes Unis'],
                ['TN', 'TUN', 'Tunisia', 'Tunisie'],
                ['TR', 'TUR', 'Turkey', 'Turquie'],
                ['TM', 'TKM', 'Turkmenistan', 'Turkm??nistan'],
                ['TC', 'TCA', 'Turks and Caicos Islands', '??les Turks et Ca??ques'],
                ['TV', 'TUV', 'Tuvalu', 'Tuvalu'],
                ['UG', 'UGA', 'Uganda', 'Ouganda'],
                ['UA', 'UKR', 'Ukraine', 'Ukraine'],
                ['MK', 'MKD', 'The Former Yugoslav Republic of Macedonia', 'L\'ex-R??publique Yougoslave de Mac??doine'],
                ['EG', 'EGY', 'Egypt', '??gypte'],
                ['GB', 'GBR', 'United Kingdom', 'Royaume-Uni'],
                ['IM', 'IMN', 'Isle of Man', '??le de Man'],
                ['TZ', 'TZA', 'United Republic Of Tanzania', 'R??publique-Unie de Tanzanie'],
                ['US', 'USA', 'United States', '??tats-Unis'],
                ['VI', 'VIR', 'U.S. Virgin Islands', '??les Vierges des ??tats-Unis'],
                ['BF', 'BFA', 'Burkina Faso', 'Burkina Faso'],
                ['UY', 'URY', 'Uruguay', 'Uruguay'],
                ['UZ', 'UZB', 'Uzbekistan', 'Ouzb??kistan'],
                ['VE', 'VEN', 'Venezuela', 'Venezuela'],
                ['WF', 'WLF', 'Wallis and Futuna', 'Wallis et Futuna'],
                ['WS', 'WSM', 'Samoa', 'Samoa'],
                ['YE', 'YEM', 'Yemen', 'Y??men'],
                ['CS', 'SCG', 'Serbia and Montenegro', 'Serbie-et-Mont??n??gro'],
                ['ZM', 'ZMB', 'Zambia', 'Zambie']
            ];

            foreach ($pays as $ps) {
                Country::create([
                        'alpha2' => $ps[0],
                        'alpha3' => $ps[1],
                        'nom_en' => $ps[2],
                        'nom_fr' => $ps[3],
                    ]);
            }
        }
    }
}
