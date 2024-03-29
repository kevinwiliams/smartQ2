<?php

namespace App\Core;

class Data
{
    public static function getCountriesList()
    {
        return array(
            'AF' => array('name' => 'Afghanistan', 'flag' => 'flags/afghanistan.svg'),
            'AX' => array('name' => 'Aland Islands', 'flag' => 'flags/aland-islands.svg'),
            'AL' => array('name' => 'Albania', 'flag' => 'flags/albania.svg'),
            'DZ' => array('name' => 'Algeria', 'flag' => 'flags/algeria.svg'),
            'AS' => array('name' => 'American Samoa', 'flag' => 'flags/american-samoa.svg'),
            'AD' => array('name' => 'Andorra', 'flag' => 'flags/andorra.svg'),
            'AO' => array('name' => 'Angola', 'flag' => 'flags/angola.svg'),
            'AI' => array('name' => 'Anguilla', 'flag' => 'flags/anguilla.svg'),
            'AG' => array('name' => 'Antigua and Barbuda', 'flag' => 'flags/antigua-and-barbuda.svg'),
            'AR' => array('name' => 'Argentina', 'flag' => 'flags/argentina.svg'),
            'AM' => array('name' => 'Armenia', 'flag' => 'flags/armenia.svg'),
            'AW' => array('name' => 'Aruba', 'flag' => 'flags/aruba.svg'),
            'AU' => array('name' => 'Australia', 'flag' => 'flags/australia.svg'),
            'AT' => array('name' => 'Austria', 'flag' => 'flags/austria.svg'),
            'AZ' => array('name' => 'Azerbaijan', 'flag' => 'flags/azerbaijan.svg'),
            'BS' => array('name' => 'Bahamas', 'flag' => 'flags/bahamas.svg'),
            'BH' => array('name' => 'Bahrain', 'flag' => 'flags/bahrain.svg'),
            'BD' => array('name' => 'Bangladesh', 'flag' => 'flags/bangladesh.svg'),
            'BB' => array('name' => 'Barbados', 'flag' => 'flags/barbados.svg'),
            'BY' => array('name' => 'Belarus', 'flag' => 'flags/belarus.svg'),
            'BE' => array('name' => 'Belgium', 'flag' => 'flags/belgium.svg'),
            'BZ' => array('name' => 'Belize', 'flag' => 'flags/belize.svg'),
            'BJ' => array('name' => 'Benin', 'flag' => 'flags/benin.svg'),
            'BM' => array('name' => 'Bermuda', 'flag' => 'flags/bermuda.svg'),
            'BT' => array('name' => 'Bhutan', 'flag' => 'flags/bhutan.svg'),
            'BO' => array('name' => 'Bolivia, Plurinational State of', 'flag' => 'flags/bolivia.svg'),
            'BQ' => array('name' => 'Bonaire, Sint Eustatius and Saba', 'flag' => 'flags/bonaire.svg'),
            'BA' => array('name' => 'Bosnia and Herzegovina', 'flag' => 'flags/bosnia-and-herzegovina.svg'),
            'BW' => array('name' => 'Botswana', 'flag' => 'flags/botswana.svg'),
            'BR' => array('name' => 'Brazil', 'flag' => 'flags/brazil.svg'),
            'IO' => array('name' => 'British Indian Ocean Territory', 'flag' => 'flags/british-indian-ocean-territory.svg'),
            'BN' => array('name' => 'Brunei Darussalam', 'flag' => 'flags/brunei.svg'),
            'BG' => array('name' => 'Bulgaria', 'flag' => 'flags/bulgaria.svg'),
            'BF' => array('name' => 'Burkina Faso', 'flag' => 'flags/burkina-faso.svg'),
            'BI' => array('name' => 'Burundi', 'flag' => 'flags/burundi.svg'),
            'KH' => array('name' => 'Cambodia', 'flag' => 'flags/cambodia.svg'),
            'CM' => array('name' => 'Cameroon', 'flag' => 'flags/cameroon.svg'),
            'CA' => array('name' => 'Canada', 'flag' => 'flags/canada.svg'),
            'CV' => array('name' => 'Cape Verde', 'flag' => 'flags/cape-verde.svg'),
            'KY' => array('name' => 'Cayman Islands', 'flag' => 'flags/cayman-islands.svg'),
            'CF' => array('name' => 'Central African Republic', 'flag' => 'flags/central-african-republic.svg'),
            'TD' => array('name' => 'Chad', 'flag' => 'flags/chad.svg'),
            'CL' => array('name' => 'Chile', 'flag' => 'flags/chile.svg'),
            'CN' => array('name' => 'China', 'flag' => 'flags/china.svg'),
            'CX' => array('name' => 'Christmas Island', 'flag' => 'flags/christmas-island.svg'),
            'CC' => array('name' => 'Cocos (Keeling) Islands', 'flag' => 'flags/cocos-island.svg'),
            'CO' => array('name' => 'Colombia', 'flag' => 'flags/colombia.svg'),
            'KM' => array('name' => 'Comoros', 'flag' => 'flags/comoros.svg'),
            'CK' => array('name' => 'Cook Islands', 'flag' => 'flags/cook-islands.svg'),
            'CR' => array('name' => 'Costa Rica', 'flag' => 'flags/costa-rica.svg'),
            'CI' => array('name' => 'Côte d\'Ivoire', 'flag' => 'flags/ivory-coast.svg'),
            'HR' => array('name' => 'Croatia', 'flag' => 'flags/croatia.svg'),
            'CU' => array('name' => 'Cuba', 'flag' => 'flags/cuba.svg'),
            'CW' => array('name' => 'Curaçao', 'flag' => 'flags/curacao.svg'),
            'CZ' => array('name' => 'Czech Republic', 'flag' => 'flags/czech-republic.svg'),
            'DK' => array('name' => 'Denmark', 'flag' => 'flags/denmark.svg'),
            'DJ' => array('name' => 'Djibouti', 'flag' => 'flags/djibouti.svg'),
            'DM' => array('name' => 'Dominica', 'flag' => 'flags/dominica.svg'),
            'DO' => array('name' => 'Dominican Republic', 'flag' => 'flags/dominican-republic.svg'),
            'EC' => array('name' => 'Ecuador', 'flag' => 'flags/ecuador.svg'),
            'EG' => array('name' => 'Egypt', 'flag' => 'flags/egypt.svg'),
            'SV' => array('name' => 'El Salvador', 'flag' => 'flags/el-salvador.svg'),
            'GQ' => array('name' => 'Equatorial Guinea', 'flag' => 'flags/equatorial-guinea.svg'),
            'ER' => array('name' => 'Eritrea', 'flag' => 'flags/eritrea.svg'),
            'EE' => array('name' => 'Estonia', 'flag' => 'flags/estonia.svg'),
            'ET' => array('name' => 'Ethiopia', 'flag' => 'flags/ethiopia.svg'),
            'FK' => array('name' => 'Falkland Islands (Malvinas)', 'flag' => 'flags/falkland-islands.svg'),
            'FJ' => array('name' => 'Fiji', 'flag' => 'flags/fiji.svg'),
            'FI' => array('name' => 'Finland', 'flag' => 'flags/finland.svg'),
            'FR' => array('name' => 'France', 'flag' => 'flags/france.svg'),
            'PF' => array('name' => 'French Polynesia', 'flag' => 'flags/french-polynesia.svg'),
            'GA' => array('name' => 'Gabon', 'flag' => 'flags/gabon.svg'),
            'GM' => array('name' => 'Gambia', 'flag' => 'flags/gambia.svg'),
            'GE' => array('name' => 'Georgia', 'flag' => 'flags/georgia.svg'),
            'DE' => array('name' => 'Germany', 'flag' => 'flags/germany.svg'),
            'GH' => array('name' => 'Ghana', 'flag' => 'flags/ghana.svg'),
            'GI' => array('name' => 'Gibraltar', 'flag' => 'flags/gibraltar.svg'),
            'GR' => array('name' => 'Greece', 'flag' => 'flags/greece.svg'),
            'GL' => array('name' => 'Greenland', 'flag' => 'flags/greenland.svg'),
            'GD' => array('name' => 'Grenada', 'flag' => 'flags/grenada.svg'),
            'GU' => array('name' => 'Guam', 'flag' => 'flags/guam.svg'),
            'GT' => array('name' => 'Guatemala', 'flag' => 'flags/guatemala.svg'),
            'GG' => array('name' => 'Guernsey', 'flag' => 'flags/guernsey.svg'),
            'GN' => array('name' => 'Guinea', 'flag' => 'flags/guinea.svg'),
            'GW' => array('name' => 'Guinea-Bissau', 'flag' => 'flags/guinea-bissau.svg'),
            'HT' => array('name' => 'Haiti', 'flag' => 'flags/haiti.svg'),
            'VA' => array('name' => 'Holy See (Vatican City State)', 'flag' => 'flags/vatican-city.svg'),
            'HN' => array('name' => 'Honduras', 'flag' => 'flags/honduras.svg'),
            'HK' => array('name' => 'Hong Kong', 'flag' => 'flags/hong-kong.svg'),
            'HU' => array('name' => 'Hungary', 'flag' => 'flags/hungary.svg'),
            'IS' => array('name' => 'Iceland', 'flag' => 'flags/iceland.svg'),
            'IN' => array('name' => 'India', 'flag' => 'flags/india.svg'),
            'ID' => array('name' => 'Indonesia', 'flag' => 'flags/indonesia.svg'),
            'IR' => array('name' => 'Iran, Islamic Republic of', 'flag' => 'flags/iran.svg'),
            'IQ' => array('name' => 'Iraq', 'flag' => 'flags/iraq.svg'),
            'IE' => array('name' => 'Ireland', 'flag' => 'flags/ireland.svg'),
            'IM' => array('name' => 'Isle of Man', 'flag' => 'flags/isle-of-man.svg'),
            'IL' => array('name' => 'Israel', 'flag' => 'flags/israel.svg'),
            'IT' => array('name' => 'Italy', 'flag' => 'flags/italy.svg'),
            'JM' => array('name' => 'Jamaica', 'flag' => 'flags/jamaica.svg'),
            'JP' => array('name' => 'Japan', 'flag' => 'flags/japan.svg'),
            'JE' => array('name' => 'Jersey', 'flag' => 'flags/jersey.svg'),
            'JO' => array('name' => 'Jordan', 'flag' => 'flags/jordan.svg'),
            'KZ' => array('name' => 'Kazakhstan', 'flag' => 'flags/kazakhstan.svg'),
            'KE' => array('name' => 'Kenya', 'flag' => 'flags/kenya.svg'),
            'KI' => array('name' => 'Kiribati', 'flag' => 'flags/kiribati.svg'),
            'KP' => array('name' => 'Korea, Democratic People\'s Republic of', 'flag' => 'flags/north-korea.svg'),
            'KW' => array('name' => 'Kuwait', 'flag' => 'flags/kuwait.svg'),
            'KG' => array('name' => 'Kyrgyzstan', 'flag' => 'flags/kyrgyzstan.svg'),
            'LA' => array('name' => 'Lao People\'s Democratic Republic', 'flag' => 'flags/laos.svg'),
            'LV' => array('name' => 'Latvia', 'flag' => 'flags/latvia.svg'),
            'LB' => array('name' => 'Lebanon', 'flag' => 'flags/lebanon.svg'),
            'LS' => array('name' => 'Lesotho', 'flag' => 'flags/lesotho.svg'),
            'LR' => array('name' => 'Liberia', 'flag' => 'flags/liberia.svg'),
            'LY' => array('name' => 'Libya', 'flag' => 'flags/libya.svg'),
            'LI' => array('name' => 'Liechtenstein', 'flag' => 'flags/liechtenstein.svg'),
            'LT' => array('name' => 'Lithuania', 'flag' => 'flags/lithuania.svg'),
            'LU' => array('name' => 'Luxembourg', 'flag' => 'flags/luxembourg.svg'),
            'MO' => array('name' => 'Macao', 'flag' => 'flags/macao.svg'),
            'MG' => array('name' => 'Madagascar', 'flag' => 'flags/madagascar.svg'),
            'MW' => array('name' => 'Malawi', 'flag' => 'flags/malawi.svg'),
            'MY' => array('name' => 'Malaysia', 'flag' => 'flags/malaysia.svg'),
            'MV' => array('name' => 'Maldives', 'flag' => 'flags/maldives.svg'),
            'ML' => array('name' => 'Mali', 'flag' => 'flags/mali.svg'),
            'MT' => array('name' => 'Malta', 'flag' => 'flags/malta.svg'),
            'MH' => array('name' => 'Marshall Islands', 'flag' => 'flags/marshall-island.svg'),
            'MQ' => array('name' => 'Martinique', 'flag' => 'flags/martinique.svg'),
            'MR' => array('name' => 'Mauritania', 'flag' => 'flags/mauritania.svg'),
            'MU' => array('name' => 'Mauritius', 'flag' => 'flags/mauritius.svg'),
            'MX' => array('name' => 'Mexico', 'flag' => 'flags/mexico.svg'),
            'FM' => array('name' => 'Micronesia, Federated States of', 'flag' => 'flags/micronesia.svg'),
            'MD' => array('name' => 'Moldova, Republic of', 'flag' => 'flags/moldova.svg'),
            'MC' => array('name' => 'Monaco', 'flag' => 'flags/monaco.svg'),
            'MN' => array('name' => 'Mongolia', 'flag' => 'flags/mongolia.svg'),
            'ME' => array('name' => 'Montenegro', 'flag' => 'flags/montenegro.svg'),
            'MS' => array('name' => 'Montserrat', 'flag' => 'flags/montserrat.svg'),
            'MA' => array('name' => 'Morocco', 'flag' => 'flags/morocco.svg'),
            'MZ' => array('name' => 'Mozambique', 'flag' => 'flags/mozambique.svg'),
            'MM' => array('name' => 'Myanmar', 'flag' => 'flags/myanmar.svg'),
            'NA' => array('name' => 'Namibia', 'flag' => 'flags/namibia.svg'),
            'NR' => array('name' => 'Nauru', 'flag' => 'flags/nauru.svg'),
            'NP' => array('name' => 'Nepal', 'flag' => 'flags/nepal.svg'),
            'NL' => array('name' => 'Netherlands', 'flag' => 'flags/netherlands.svg'),
            'NZ' => array('name' => 'New Zealand', 'flag' => 'flags/new-zealand.svg'),
            'NI' => array('name' => 'Nicaragua', 'flag' => 'flags/nicaragua.svg'),
            'NE' => array('name' => 'Niger', 'flag' => 'flags/niger.svg'),
            'NG' => array('name' => 'Nigeria', 'flag' => 'flags/nigeria.svg'),
            'NU' => array('name' => 'Niue', 'flag' => 'flags/niue.svg'),
            'NF' => array('name' => 'Norfolk Island', 'flag' => 'flags/norfolk-island.svg'),
            'MP' => array('name' => 'Northern Mariana Islands', 'flag' => 'flags/northern-mariana-islands.svg'),
            'NO' => array('name' => 'Norway', 'flag' => 'flags/norway.svg'),
            'OM' => array('name' => 'Oman', 'flag' => 'flags/oman.svg'),
            'PK' => array('name' => 'Pakistan', 'flag' => 'flags/pakistan.svg'),
            'PW' => array('name' => 'Palau', 'flag' => 'flags/palau.svg'),
            'PS' => array('name' => 'Palestinian Territory, Occupied', 'flag' => 'flags/palestine.svg'),
            'PA' => array('name' => 'Panama', 'flag' => 'flags/panama.svg'),
            'PG' => array('name' => 'Papua New Guinea', 'flag' => 'flags/papua-new-guinea.svg'),
            'PY' => array('name' => 'Paraguay', 'flag' => 'flags/paraguay.svg'),
            'PE' => array('name' => 'Peru', 'flag' => 'flags/peru.svg'),
            'PH' => array('name' => 'Philippines', 'flag' => 'flags/philippines.svg'),
            'PL' => array('name' => 'Poland', 'flag' => 'flags/poland.svg'),
            'PT' => array('name' => 'Portugal', 'flag' => 'flags/portugal.svg'),
            'PR' => array('name' => 'Puerto Rico', 'flag' => 'flags/puerto-rico.svg'),
            'QA' => array('name' => 'Qatar', 'flag' => 'flags/qatar.svg'),
            'RO' => array('name' => 'Romania', 'flag' => 'flags/romania.svg'),
            'RU' => array('name' => 'Russian Federation', 'flag' => 'flags/russia.svg'),
            'RW' => array('name' => 'Rwanda', 'flag' => 'flags/rwanda.svg'),
            'BL' => array('name' => 'Saint Barthélemy', 'flag' => 'flags/st-barts.svg'),
            'KN' => array('name' => 'Saint Kitts and Nevis', 'flag' => 'flags/saint-kitts-and-nevis.svg'),
            'LC' => array('name' => 'Saint Lucia', 'flag' => 'flags/st-lucia.svg'),
            'MF' => array('name' => 'Saint Martin (French part)', 'flag' => 'flags/sint-maarten.svg'),
            // 'PM' => array('name' => 'Saint Pierre and Miquelon', 'flag' => 'flags/saint-pierre.svg'),
            'VC' => array('name' => 'Saint Vincent and the Grenadines', 'flag' => 'flags/st-vincent-and-the-grenadines.svg'),
            'WS' => array('name' => 'Samoa', 'flag' => 'flags/samoa.svg'),
            'SM' => array('name' => 'San Marino', 'flag' => 'flags/san-marino.svg'),
            'ST' => array('name' => 'Sao Tome and Principe', 'flag' => 'flags/sao-tome-and-prince.svg'),
            'SA' => array('name' => 'Saudi Arabia', 'flag' => 'flags/saudi-arabia.svg'),
            'SN' => array('name' => 'Senegal', 'flag' => 'flags/senegal.svg'),
            'RS' => array('name' => 'Serbia', 'flag' => 'flags/serbia.svg'),
            'SC' => array('name' => 'Seychelles', 'flag' => 'flags/seychelles.svg'),
            'SL' => array('name' => 'Sierra Leone', 'flag' => 'flags/sierra-leone.svg'),
            'SG' => array('name' => 'Singapore', 'flag' => 'flags/singapore.svg'),
            'SX' => array('name' => 'Sint Maarten (Dutch part)', 'flag' => 'flags/sint-maarten.svg'),
            'SK' => array('name' => 'Slovakia', 'flag' => 'flags/slovakia.svg'),
            'SI' => array('name' => 'Slovenia', 'flag' => 'flags/slovenia.svg'),
            'SB' => array('name' => 'Solomon Islands', 'flag' => 'flags/solomon-islands.svg'),
            'SO' => array('name' => 'Somalia', 'flag' => 'flags/somalia.svg'),
            'ZA' => array('name' => 'South Africa', 'flag' => 'flags/south-africa.svg'),
            'KR' => array('name' => 'South Korea', 'flag' => 'flags/south-korea.svg'),
            'SS' => array('name' => 'South Sudan', 'flag' => 'flags/south-sudan.svg'),
            'ES' => array('name' => 'Spain', 'flag' => 'flags/spain.svg'),
            'LK' => array('name' => 'Sri Lanka', 'flag' => 'flags/sri-lanka.svg'),
            'SD' => array('name' => 'Sudan', 'flag' => 'flags/sudan.svg'),
            'SR' => array('name' => 'Suriname', 'flag' => 'flags/suriname.svg'),
            'SZ' => array('name' => 'Swaziland', 'flag' => 'flags/swaziland.svg'),
            'SE' => array('name' => 'Sweden', 'flag' => 'flags/sweden.svg'),
            'CH' => array('name' => 'Switzerland', 'flag' => 'flags/switzerland.svg'),
            'SY' => array('name' => 'Syrian Arab Republic', 'flag' => 'flags/syria.svg'),
            'TW' => array('name' => 'Taiwan, Province of China', 'flag' => 'flags/taiwan.svg'),
            'TJ' => array('name' => 'Tajikistan', 'flag' => 'flags/tajikistan.svg'),
            'TZ' => array('name' => 'Tanzania, United Republic of', 'flag' => 'flags/tanzania.svg'),
            'TH' => array('name' => 'Thailand', 'flag' => 'flags/thailand.svg'),
            'TG' => array('name' => 'Togo', 'flag' => 'flags/togo.svg'),
            'TK' => array('name' => 'Tokelau', 'flag' => 'flags/tokelau.svg'),
            'TO' => array('name' => 'Tonga', 'flag' => 'flags/tonga.svg'),
            'TT' => array('name' => 'Trinidad and Tobago', 'flag' => 'flags/trinidad-and-tobago.svg'),
            'TN' => array('name' => 'Tunisia', 'flag' => 'flags/tunisia.svg'),
            'TR' => array('name' => 'Turkey', 'flag' => 'flags/turkey.svg'),
            'TM' => array('name' => 'Turkmenistan', 'flag' => 'flags/turkmenistan.svg'),
            'TC' => array('name' => 'Turks and Caicos Islands', 'flag' => 'flags/turks-and-caicos.svg'),
            'TV' => array('name' => 'Tuvalu', 'flag' => 'flags/tuvalu.svg'),
            'UG' => array('name' => 'Uganda', 'flag' => 'flags/uganda.svg'),
            'UA' => array('name' => 'Ukraine', 'flag' => 'flags/ukraine.svg'),
            'AE' => array('name' => 'United Arab Emirates', 'flag' => 'flags/united-arab-emirates.svg'),
            'GB' => array('name' => 'United Kingdom', 'flag' => 'flags/united-kingdom.svg'),
            'US' => array('name' => 'United States', 'flag' => 'flags/united-states.svg'),
            'UY' => array('name' => 'Uruguay', 'flag' => 'flags/uruguay.svg'),
            'UZ' => array('name' => 'Uzbekistan', 'flag' => 'flags/uzbekistan.svg'),
            'VU' => array('name' => 'Vanuatu', 'flag' => 'flags/vanuatu.svg'),
            'VE' => array('name' => 'Venezuela, Bolivarian Republic of', 'flag' => 'flags/venezuela.svg'),
            'VN' => array('name' => 'Vietnam', 'flag' => 'flags/vietnam.svg'),
            'VI' => array('name' => 'Virgin Islands', 'flag' => 'flags/virgin-islands.svg'),
            'YE' => array('name' => 'Yemen', 'flag' => 'flags/yemen.svg'),
            'ZM' => array('name' => 'Zambia', 'flag' => 'flags/zambia.svg'),
            'ZW' => array('name' => 'Zimbabwe', 'flag' => 'flags/zimbabwe.svg')
        );
    }

    public static function getLanguagesList()
    {
        $countryArr = Data::getCountriesList();

        return array(
            'id' => array('name' => 'Bahasa Indonesia - Indonesian', 'country' => $countryArr['ID']),
            'msa' => array('name' => 'Bahasa Melayu - Malay', 'country' => $countryArr['MY']),
            'ca' => array('name' => 'Català - Catalan', 'country' => $countryArr['CA']),
            'cs' => array('name' => 'Čeština - Czech', 'country' => $countryArr['CZ']),
            'da' => array('name' => 'Dansk - Danish', 'country' => $countryArr['NL']),
            'de' => array('name' => 'Deutsch - German', 'country' => $countryArr['DE']),
            'en' => array('name' => 'English', 'country' => $countryArr['GB']),
            'en-gb' => array('name' => 'English UK - British English', 'country' => $countryArr['GB']),
            'es' => array('name' => 'Español - Spanish', 'country' => $countryArr['ES']),
            'fil' => array('name' => 'Filipino', 'country' => $countryArr['PH']),
            'fr' => array('name' => 'Français - French', 'country' => $countryArr['FR']),
            'ga' => array('name' => 'Gaeilge - Irish (beta)', 'country' => $countryArr['GA']),
            'gl' => array('name' => 'Galego - Galician (beta)', 'country' => $countryArr['GL']),
            'hr' => array('name' => 'Hrvatski - Croatian', 'country' => $countryArr['HR']),
            'it' => array('name' => 'Italiano - Italian', 'country' => $countryArr['IT']),
            'hu' => array('name' => 'Magyar - Hungarian', 'country' => $countryArr['HU']),
            'nl' => array('name' => 'Nederlands - Dutch', 'country' => $countryArr['NL']),
            'no' => array('name' => 'Norsk - Norwegian', 'country' => $countryArr['NO']),
            'pl' => array('name' => 'Polski - Polish', 'country' => $countryArr['PL']),
            'pt' => array('name' => 'Português - Portuguese', 'country' => $countryArr['PT']),
            'ro' => array('name' => 'Română - Romanian', 'country' => $countryArr['RO']),
            'sk' => array('name' => 'Slovenčina - Slovak', 'country' => $countryArr['SK']),
            'fi' => array('name' => 'Suomi - Finnish', 'country' => $countryArr['FI']),
            'sv' => array('name' => 'Svenska - Swedish', 'country' => $countryArr['SV']),
            'vi' => array('name' => 'Tiếng Việt - Vietnamese', 'country' => $countryArr['VI']),
            'tr' => array('name' => 'Türkçe - Turkish', 'country' => $countryArr['TR']),
            'el' => array('name' => 'Ελληνικά - Greek', 'country' => $countryArr['GR']),
            'bg' => array('name' => 'Български език - Bulgarian', 'country' => $countryArr['BG']),
            'ru' => array('name' => 'Русский - Russian', 'country' => $countryArr['RU']),
            'sr' => array('name' => 'Српски - Serbian', 'country' => $countryArr['SR']),
            'uk' => array('name' => 'Українська мова - Ukrainian', 'country' => $countryArr['UA']),
            'he' => array('name' => 'עִבְרִית - Hebrew', 'country' => $countryArr['IL']),
            'ur' => array('name' => 'اردو - Urdu (beta)', 'country' => $countryArr['PK']),
            'ar' => array('name' => 'العربية - Arabic', 'country' => $countryArr['AR']),
            'fa' => array('name' => 'فارسی - Persian', 'country' => $countryArr['AR']),
            'mr' => array('name' => 'मराठी - Marathi', 'country' => $countryArr['MR']),
            'hi' => array('name' => 'हिन्दी - Hindi', 'country' => $countryArr['IN']),
            'bn' => array('name' => 'বাংলা - Bangla', 'country' => $countryArr['BD']),
            'gu' => array('name' => 'ગુજરાતી - Gujarati', 'country' => $countryArr['GU']),
            'ta' => array('name' => 'தமிழ் - Tamil', 'country' => $countryArr['IN']),
            'kn' => array('name' => 'ಕನ್ನಡ - Kannada', 'country' => $countryArr['KN']),
            'th' => array('name' => 'ภาษาไทย - Thai', 'country' => $countryArr['TH']),
            'ko' => array('name' => '한국어 - Korean', 'country' => $countryArr['KR']),
            'ja' => array('name' => '日本語 - Japanese', 'country' => $countryArr['JP']),
            'zh-cn' => array('name' => '简体中文 - Simplified Chinese', 'country' => $countryArr['CN']),
            'zh-tw' => array('name' => '繁體中文 - Traditional Chinese', 'country' => $countryArr['TW'])
        );
    }

    public static function getCurrencyList()
    {
        $countryArr = Data::getCountriesList();

        return array(
            'USD' => array('name' => 'USA dollar', 'country' => $countryArr['US']),
            'GBP' => array('name' => 'British pound', 'country' => $countryArr['GB']),
            'AUD' => array('name' => 'Australian dollar', 'country' => $countryArr['AU']),
            'JPY' => array('name' => 'Japanese yen', 'country' => $countryArr['JP']),
            'SEK' => array('name' => 'Swedish krona', 'country' => $countryArr['SE']),
            'CAD' => array('name' => 'Canadian dollar', 'country' => $countryArr['CA']),
            'CHF' => array('name' => 'Swiss franc', 'country' => $countryArr['CH'])
        );
    }

    public static function getTimeZonesList()
    {
        return array(
            'International Date Line West' => array('name' => '(GMT-11:00) International Date Line West', 'offset' => '-39600'),
            'Midway Island' => array('name' => '(GMT-11:00) Midway Island', 'offset' => '-39600'),
            'Samoa' => array('name' => '(GMT-11:00) Samoa', 'offset' => '-39600'),
            'Hawaii' => array('name' => '(GMT-10:00) Hawaii', 'offset' => '-36000'),
            'Alaska' => array('name' => '(GMT-08:00) Alaska', 'offset' => '-28800'),
            'Pacific Time (US & Canada)' => array('name' => '(GMT-07:00) Pacific Time (US & Canada)', 'offset' => '-25200'),
            'Tijuana' => array('name' => '(GMT-07:00) Tijuana', 'offset' => '-25200'),
            'Arizona' => array('name' => '(GMT-07:00) Arizona', 'offset' => '-25200'),
            'Mountain Time (US & Canada)' => array('name' => '(GMT-06:00) Mountain Time (US & Canada)', 'offset' => '-21600'),
            'Chihuahua' => array('name' => '(GMT-06:00) Chihuahua', 'offset' => '-21600'),
            'Mazatlan' => array('name' => '(GMT-06:00) Mazatlan', 'offset' => '-21600'),
            'Saskatchewan' => array('name' => '(GMT-06:00) Saskatchewan', 'offset' => '-21600'),
            'Central America' => array('name' => '(GMT-06:00) Central America', 'offset' => '-21600'),
            'Central Time (US & Canada)' => array('name' => '(GMT-05:00) Central Time (US & Canada)', 'offset' => '-18000'),
            'Guadalajara' => array('name' => '(GMT-05:00) Guadalajara', 'offset' => '-18000'),
            'Mexico City' => array('name' => '(GMT-05:00) Mexico City', 'offset' => '-18000'),
            'Monterrey' => array('name' => '(GMT-05:00) Monterrey', 'offset' => '-18000'),
            'Bogota' => array('name' => '(GMT-05:00) Bogota', 'offset' => '-18000'),
            'Lima' => array('name' => '(GMT-05:00) Lima', 'offset' => '-18000'),
            'Quito' => array('name' => '(GMT-05:00) Quito', 'offset' => '-18000'),
            'Eastern Time (US & Canada)' => array('name' => '(GMT-04:00) Eastern Time (US & Canada)', 'offset' => '-14400'),
            'Indiana (East)' => array('name' => '(GMT-04:00) Indiana (East)', 'offset' => '-14400'),
            'Caracas' => array('name' => '(GMT-04:00) Caracas', 'offset' => '-14400'),
            'La Paz' => array('name' => '(GMT-04:00) La Paz', 'offset' => '-14400'),
            'Georgetown' => array('name' => '(GMT-04:00) Georgetown', 'offset' => '-14400'),
            'Atlantic Time (Canada)' => array('name' => '(GMT-03:00) Atlantic Time (Canada)', 'offset' => '-10800'),
            'Santiago' => array('name' => '(GMT-03:00) Santiago', 'offset' => '-10800'),
            'Brasilia' => array('name' => '(GMT-03:00) Brasilia', 'offset' => '-10800'),
            'Buenos Aires' => array('name' => '(GMT-03:00) Buenos Aires', 'offset' => '-10800'),
            'Newfoundland' => array('name' => '(GMT-02:30) Newfoundland', 'offset' => '-9000'),
            'Greenland' => array('name' => '(GMT-02:00) Greenland', 'offset' => '-7200'),
            'Mid-Atlantic' => array('name' => '(GMT-02:00) Mid-Atlantic', 'offset' => '-7200'),
            'Cape Verde Is.' => array('name' => '(GMT-01:00) Cape Verde Is.', 'offset' => '-3600'),
            'Azores' => array('name' => '(GMT) Azores', 'offset' => '0'),
            'Monrovia' => array('name' => '(GMT) Monrovia', 'offset' => '0'),
            'UTC' => array('name' => '(GMT) UTC', 'offset' => '0'),
            'Dublin' => array('name' => '(GMT+01:00) Dublin', 'offset' => '3600'),
            'Edinburgh' => array('name' => '(GMT+01:00) Edinburgh', 'offset' => '3600'),
            'Lisbon' => array('name' => '(GMT+01:00) Lisbon', 'offset' => '3600'),
            'London' => array('name' => '(GMT+01:00) London', 'offset' => '3600'),
            'Casablanca' => array('name' => '(GMT+01:00) Casablanca', 'offset' => '3600'),
            'West Central Africa' => array('name' => '(GMT+01:00) West Central Africa', 'offset' => '3600'),
            'Belgrade' => array('name' => '(GMT+02:00) Belgrade', 'offset' => '7200'),
            'Bratislava' => array('name' => '(GMT+02:00) Bratislava', 'offset' => '7200'),
            'Budapest' => array('name' => '(GMT+02:00) Budapest', 'offset' => '7200'),
            'Ljubljana' => array('name' => '(GMT+02:00) Ljubljana', 'offset' => '7200'),
            'Prague' => array('name' => '(GMT+02:00) Prague', 'offset' => '7200'),
            'Sarajevo' => array('name' => '(GMT+02:00) Sarajevo', 'offset' => '7200'),
            'Skopje' => array('name' => '(GMT+02:00) Skopje', 'offset' => '7200'),
            'Warsaw' => array('name' => '(GMT+02:00) Warsaw', 'offset' => '7200'),
            'Zagreb' => array('name' => '(GMT+02:00) Zagreb', 'offset' => '7200'),
            'Brussels' => array('name' => '(GMT+02:00) Brussels', 'offset' => '7200'),
            'Copenhagen' => array('name' => '(GMT+02:00) Copenhagen', 'offset' => '7200'),
            'Madrid' => array('name' => '(GMT+02:00) Madrid', 'offset' => '7200'),
            'Paris' => array('name' => '(GMT+02:00) Paris', 'offset' => '7200'),
            'Amsterdam' => array('name' => '(GMT+02:00) Amsterdam', 'offset' => '7200'),
            'Berlin' => array('name' => '(GMT+02:00) Berlin', 'offset' => '7200'),
            'Bern' => array('name' => '(GMT+02:00) Bern', 'offset' => '7200'),
            'Rome' => array('name' => '(GMT+02:00) Rome', 'offset' => '7200'),
            'Stockholm' => array('name' => '(GMT+02:00) Stockholm', 'offset' => '7200'),
            'Vienna' => array('name' => '(GMT+02:00) Vienna', 'offset' => '7200'),
            'Cairo' => array('name' => '(GMT+02:00) Cairo', 'offset' => '7200'),
            'Harare' => array('name' => '(GMT+02:00) Harare', 'offset' => '7200'),
            'Pretoria' => array('name' => '(GMT+02:00) Pretoria', 'offset' => '7200'),
            'Bucharest' => array('name' => '(GMT+03:00) Bucharest', 'offset' => '10800'),
            'Helsinki' => array('name' => '(GMT+03:00) Helsinki', 'offset' => '10800'),
            'Kiev' => array('name' => '(GMT+03:00) Kiev', 'offset' => '10800'),
            'Kyiv' => array('name' => '(GMT+03:00) Kyiv', 'offset' => '10800'),
            'Riga' => array('name' => '(GMT+03:00) Riga', 'offset' => '10800'),
            'Sofia' => array('name' => '(GMT+03:00) Sofia', 'offset' => '10800'),
            'Tallinn' => array('name' => '(GMT+03:00) Tallinn', 'offset' => '10800'),
            'Vilnius' => array('name' => '(GMT+03:00) Vilnius', 'offset' => '10800'),
            'Athens' => array('name' => '(GMT+03:00) Athens', 'offset' => '10800'),
            'Istanbul' => array('name' => '(GMT+03:00) Istanbul', 'offset' => '10800'),
            'Minsk' => array('name' => '(GMT+03:00) Minsk', 'offset' => '10800'),
            'Jerusalem' => array('name' => '(GMT+03:00) Jerusalem', 'offset' => '10800'),
            'Moscow' => array('name' => '(GMT+03:00) Moscow', 'offset' => '10800'),
            'St. Petersburg' => array('name' => '(GMT+03:00) St. Petersburg', 'offset' => '10800'),
            'Volgograd' => array('name' => '(GMT+03:00) Volgograd', 'offset' => '10800'),
            'Kuwait' => array('name' => '(GMT+03:00) Kuwait', 'offset' => '10800'),
            'Riyadh' => array('name' => '(GMT+03:00) Riyadh', 'offset' => '10800'),
            'Nairobi' => array('name' => '(GMT+03:00) Nairobi', 'offset' => '10800'),
            'Baghdad' => array('name' => '(GMT+03:00) Baghdad', 'offset' => '10800'),
            'Abu Dhabi' => array('name' => '(GMT+04:00) Abu Dhabi', 'offset' => '14400'),
            'Muscat' => array('name' => '(GMT+04:00) Muscat', 'offset' => '14400'),
            'Baku' => array('name' => '(GMT+04:00) Baku', 'offset' => '14400'),
            'Tbilisi' => array('name' => '(GMT+04:00) Tbilisi', 'offset' => '14400'),
            'Yerevan' => array('name' => '(GMT+04:00) Yerevan', 'offset' => '14400'),
            'Tehran' => array('name' => '(GMT+04:30) Tehran', 'offset' => '16200'),
            'Kabul' => array('name' => '(GMT+04:30) Kabul', 'offset' => '16200'),
            'Ekaterinburg' => array('name' => '(GMT+05:00) Ekaterinburg', 'offset' => '18000'),
            'Islamabad' => array('name' => '(GMT+05:00) Islamabad', 'offset' => '18000'),
            'Karachi' => array('name' => '(GMT+05:00) Karachi', 'offset' => '18000'),
            'Tashkent' => array('name' => '(GMT+05:00) Tashkent', 'offset' => '18000'),
            'Chennai' => array('name' => '(GMT+05:30) Chennai', 'offset' => '19800'),
            'Kolkata' => array('name' => '(GMT+05:30) Kolkata', 'offset' => '19800'),
            'Mumbai' => array('name' => '(GMT+05:30) Mumbai', 'offset' => '19800'),
            'New Delhi' => array('name' => '(GMT+05:30) New Delhi', 'offset' => '19800'),
            'Sri Jayawardenepura' => array('name' => '(GMT+05:30) Sri Jayawardenepura', 'offset' => '19800'),
            'Kathmandu' => array('name' => '(GMT+05:45) Kathmandu', 'offset' => '20700'),
            'Astana' => array('name' => '(GMT+06:00) Astana', 'offset' => '21600'),
            'Dhaka' => array('name' => '(GMT+06:00) Dhaka', 'offset' => '21600'),
            'Almaty' => array('name' => '(GMT+06:00) Almaty', 'offset' => '21600'),
            'Urumqi' => array('name' => '(GMT+06:00) Urumqi', 'offset' => '21600'),
            'Rangoon' => array('name' => '(GMT+06:30) Rangoon', 'offset' => '23400'),
            'Novosibirsk' => array('name' => '(GMT+07:00) Novosibirsk', 'offset' => '25200'),
            'Bangkok' => array('name' => '(GMT+07:00) Bangkok', 'offset' => '25200'),
            'Hanoi' => array('name' => '(GMT+07:00) Hanoi', 'offset' => '25200'),
            'Jakarta' => array('name' => '(GMT+07:00) Jakarta', 'offset' => '25200'),
            'Krasnoyarsk' => array('name' => '(GMT+07:00) Krasnoyarsk', 'offset' => '25200'),
            'Beijing' => array('name' => '(GMT+08:00) Beijing', 'offset' => '28800'),
            'Chongqing' => array('name' => '(GMT+08:00) Chongqing', 'offset' => '28800'),
            'Hong Kong' => array('name' => '(GMT+08:00) Hong Kong', 'offset' => '28800'),
            'Kuala Lumpur' => array('name' => '(GMT+08:00) Kuala Lumpur', 'offset' => '28800'),
            'Singapore' => array('name' => '(GMT+08:00) Singapore', 'offset' => '28800'),
            'Taipei' => array('name' => '(GMT+08:00) Taipei', 'offset' => '28800'),
            'Perth' => array('name' => '(GMT+08:00) Perth', 'offset' => '28800'),
            'Irkutsk' => array('name' => '(GMT+08:00) Irkutsk', 'offset' => '28800'),
            'Ulaan Bataar' => array('name' => '(GMT+08:00) Ulaan Bataar', 'offset' => '28800'),
            'Seoul' => array('name' => '(GMT+09:00) Seoul', 'offset' => '32400'),
            'Osaka' => array('name' => '(GMT+09:00) Osaka', 'offset' => '32400'),
            'Sapporo' => array('name' => '(GMT+09:00) Sapporo', 'offset' => '32400'),
            'Tokyo' => array('name' => '(GMT+09:00) Tokyo', 'offset' => '32400'),
            'Yakutsk' => array('name' => '(GMT+09:00) Yakutsk', 'offset' => '32400'),
            'Darwin' => array('name' => '(GMT+09:30) Darwin', 'offset' => '34200'),
            'Adelaide' => array('name' => '(GMT+09:30) Adelaide', 'offset' => '34200'),
            'Canberra' => array('name' => '(GMT+10:00) Canberra', 'offset' => '36000'),
            'Melbourne' => array('name' => '(GMT+10:00) Melbourne', 'offset' => '36000'),
            'Sydney' => array('name' => '(GMT+10:00) Sydney', 'offset' => '36000'),
            'Brisbane' => array('name' => '(GMT+10:00) Brisbane', 'offset' => '36000'),
            'Hobart' => array('name' => '(GMT+10:00) Hobart', 'offset' => '36000'),
            'Vladivostok' => array('name' => '(GMT+10:00) Vladivostok', 'offset' => '36000'),
            'Guam' => array('name' => '(GMT+10:00) Guam', 'offset' => '36000'),
            'Port Moresby' => array('name' => '(GMT+10:00) Port Moresby', 'offset' => '36000'),
            'Solomon Is.' => array('name' => '(GMT+10:00) Solomon Is.', 'offset' => '36000'),
            'Magadan' => array('name' => '(GMT+11:00) Magadan', 'offset' => '39600'),
            'New Caledonia' => array('name' => '(GMT+11:00) New Caledonia', 'offset' => '39600'),
            'Fiji' => array('name' => '(GMT+12:00) Fiji', 'offset' => '43200'),
            'Kamchatka' => array('name' => '(GMT+12:00) Kamchatka', 'offset' => '43200'),
            'Marshall Is.' => array('name' => '(GMT+12:00) Marshall Is.', 'offset' => '43200'),
            'Auckland' => array('name' => '(GMT+12:00) Auckland', 'offset' => '43200'),
            'Wellington' => array('name' => '(GMT+12:00) Wellington', 'offset' => '43200'),
            'Nuku\'alofa' => array('name' => '(GMT+13:00) Nuku\'alofa', 'offset' => '46800')
        );
    }

    public static function getSampleUserInfo($index = -1)
    {
        $users = array(
            array(
                'name' => 'Emma Smith',
                'avatar' => 'avatars/300-6.jpg',
                'email' => 'e.smith@kpmg.com.au',
                'position' => 'Art Director',
                "online" => false
            ),
            array(
                'name' => 'Melody Macy',
                'initials' => array('label' => 'M', 'state' => 'danger'),
                'email' => 'melody@altbox.com',
                'position' => 'Marketing Analytic',
                "online" => true
            ),
            array(
                'name' => 'Max Smith',
                'avatar' => 'avatars/300-1.jpg',
                'email' => 'max@kt.com',
                'position' => 'Software Enginer',
                "online" => false
            ),
            array(
                'name' => 'Sean Bean',
                'avatar' => 'avatars/300-5.jpg',
                'email' => 'sean@dellito.com',
                'position' => 'Web Developer',
                "online" => false
            ),
            array(
                'name' => 'Brian Cox',
                'avatar' => 'avatars/300-25.jpg',
                'email' => 'brian@exchange.com',
                'position' => 'UI/UX Designer',
                "online" => false
            ),
            array(
                'name' => 'Mikaela Collins',
                'initials' => array('label' => 'C', 'state' => 'warning'),
                'email' => 'mikaela@pexcom.com',
                'position' => 'Head Of Marketing',
                "online" => true
            ),
            array(
                'name' => 'Francis Mitcham',
                'avatar' => 'avatars/300-9.jpg',
                'email' => 'f.mitcham@kpmg.com.au',
                'position' => 'Software Arcitect',
                "online" => false
            ),

            array(
                'name' => 'Olivia Wild',
                'initials' => array('label' => 'O', 'state' => 'danger'),
                'email' => 'olivia@corpmail.com',
                'position' => 'System Admin',
                "online" => true
            ),
            array(
                'name' => 'Neil Owen',
                'initials' => array('label' => 'N', 'state' => 'primary'),
                'email' => 'owen.neil@gmail.com',
                'position' => 'Account Manager',
                "online" => true
            ),
            array(
                'name' => 'Dan Wilson',
                'avatar' => 'avatars/300-23.jpg',
                'email' => 'dam@consilting.com',
                'position' => 'Web Desinger',
                "online" => false
            ),
            array(
                'name' => 'Emma Bold',
                'initials' => array('label' => 'E', 'state' => 'danger'),
                'email' => 'emma@intenso.com',
                'position' => 'Corporate Finance',
                "online" => true
            ),
            array(
                'name' => 'Ana Crown',
                'avatar' => 'avatars/300-12.jpg',
                'email' => 'ana.cf@limtel.com',
                'position' => 'Customer Relationship',
                "online" => false
            ),
            array(
                'name' => 'Robert Doe',
                'initials' => array('label' => 'A', 'state' => 'info'),
                'email' => 'robert@benko.com',
                'position' => 'Marketing Executive',
                "online" => true
            ),
            array(
                'name' => 'John Miller',
                'avatar' => 'avatars/300-13.jpg',
                'email' => 'miller@mapple.com',
                'position' => 'Project Manager',
                "online" => false
            ),
            array(
                'name' => 'Lucy Kunic',
                'initials' => array('label' => 'L', 'state' => 'success'),
                'email' => 'lucy.m@fentech.com',
                'position' => 'SEO Master',
                "online" => true
            ),
            array(
                'name' => 'Ethan Wilder',
                'avatar' => 'avatars/300-21.jpg',
                'email' => 'ethan@loop.com.au',
                'position' => 'Accountant',
                "online" => true
            )
        );

        $total = count($users);

        if ($index === -1 || isset($users[$index]) === false) {
            $index = rand(0, $total - 1);
        }

        return $users[$index];
    }

    public static function getSampleStatus($index = -1)
    {
        $statuses = array(
            array('label' => 'Approved', 'state' => 'success'),
            array('label' => 'Pending', 'state' => 'warning'),
            array('label' => 'Rejected', 'state' => 'danger'),
            array('label' => 'In progress', 'state' => 'info'),
            array('label' => 'Completed', 'state' => 'primary'),
        );

        $total = count($statuses);

        if ($index === -1 || isset($statuses[$index]) === false) {
            $index = rand(0, $total - 2);
        }

        return $statuses[$index];
    }

    public static function getSampleDate()
    {
        $dates = array('Feb 21', 'Mar 10', 'Apr 15', 'May 05', 'Jun 20', 'Jun 24', 'Jul 25', 'Aug 19', 'Sep 22', 'Oct 25', 'Nov 10', 'Dec 20');

        $date = $dates[rand(0, count($dates) - 1)] . ", " . date("Y");

        return $date;
    }

    public static function getSampleDatetime()
    {
        $dates = array('21 Feb', '10 Mar', '15 Apr', '05 May', '20 Jun', '24 Jun', '25 Jul', '19 Aug', '22 Sep', '25 Oct', '10 Nov', '20 Dec');
        $times = array('8:43 pm', '10:30 am', '5:20 pm', '2:40 pm', '11:05 am', '10:10 pm', '6:05 pm', '11:30 am', '5:30 pm', '9:23 pm', '6:43 am');

        $date = $dates[rand(0, count($dates) - 1)] . " " . date("Y") . ", " . $times[rand(0, count($times) - 1)];

        return $date;
    }

    public static function getDefaultDisplay()
    {
        return array(
            "message" => "Token - Queue Management System",
            "direction" => "left",
            "color" => "#ffffff",
            "background_color" => "#b0b0b0",
            "border_color" => "#fafdff",
            "time_format" => "H:i:s",
            "date_format" => "d M, Y",
            "display" => 2,
            "keyboard_mode" => 0,
            "sms_alert" => 1,
            "show_note" => 0,
            "show_officer" => 0,
            "show_department" => 1,
            "enable_greeting" => 0,
            "enable_qr_checkin" => 0,
            "alert_position" => 2,
            "language" => "English",
            "title" => "SmartQ",
            "paper_size" => "a4",
            "paper_orientation" => "portrait",
            "timezone" => "America/Bogota",
        );
    }

    public static function getReportList()
    {
        return array(
            array('id' => 1, 'group' => 'Visit Reports', 'name' => 'Hourly', 'title' => 'Visit Report - Hourly', 'status' => true, 'view' => 'partials/reports/hourly-token-report', 'reportview' => 'partials/scheduledreports/hourly-token-report', 'orientation' => 'landscape', 'pageSize' => 'A4'),
            array('id' => 2, 'group' => 'Visit Reports', 'name' => 'Daily', 'title' => 'Visit Report - Daily', 'status' => true, 'view' => 'partials/reports/daily-token-report', 'reportview' => 'partials/scheduledreports/daily-token-report', 'orientation' => 'portrait', 'pageSize' => 'A4'),
            array('id' => 3, 'group' => 'Visit Reports', 'name' => 'Weekly', 'title' => 'Visit Report - Weekly', 'status' => true, 'view' => 'partials/reports/weekly-token-report', 'reportview' => 'partials/scheduledreports/weekly-token-report', 'orientation' => 'portrait', 'pageSize' => 'A4'),
            array('id' => 4, 'group' => 'Visit Reports', 'name' => 'Monthly', 'title' => 'Visit Report - Monthly', 'status' => true, 'view' => 'partials/reports/monthly-token-report', 'reportview' => 'partials/scheduledreports/monthly-token-report', 'orientation' => 'landscape', 'pageSize' => 'A4'),
            array('id' => 5, 'group' => 'KPI Reports', 'name' => 'Wait Time', 'title' => 'KPI Report - Wait Time', 'status' => true, 'view' => 'partials/reports/wait-time-report', 'reportview' => 'partials/scheduledreports/wait-time-report', 'orientation' => 'portrait', 'pageSize' => 'A4'),
            array('id' => 6, 'group' => 'KPI Reports', 'name' => 'Service Time', 'title' => 'KPI Report - Service Time', 'status' => true, 'view' => 'partials/reports/wait-time-report', 'reportview' => 'partials/scheduledreports/wait-time-report', 'orientation' => 'portrait', 'pageSize' => 'A4'),
            array('id' => 7, 'group' => 'Stats Reports', 'name' => 'Customers Served', 'title' => 'Stats Report - Customers Served', 'status' => false, 'view' => 'partials/reports/customers-served-report', 'reportview' => 'partials/scheduledreports/customers-served-report', 'orientation' => 'portrait', 'pageSize' => 'A4'),
            array('id' => 8, 'group' => 'Stats Reports', 'name' => 'No Shows', 'title' => 'Stats Report - No Shows', 'status' => true, 'view' => 'partials/reports/customers-served-report', 'reportview' => 'partials/scheduledreports/customers-served-report', 'orientation' => 'portrait', 'pageSize' => 'A4'),
            array('id' => 9, 'group' => 'General Reports', 'name' => 'Token', 'title' => 'Token Report', 'status' => true, 'view' => 'partials/reports/token-report', 'reportview' => 'partials/scheduledreports/token-report', 'orientation' => 'portrait', 'pageSize' => 'A4'),
            array('id' => 10, 'group' => 'General Reports', 'name' => 'Performance', 'title' => 'Performance Report', 'status' => true, 'view' => 'partials/reports/performance-report', 'reportview' => 'partials/scheduledreports/performance-report', 'orientation' => 'portrait', 'pageSize' => 'A4'),
            array('id' => 11, 'group' => 'General Reports', 'name' => 'Reason for Visit', 'title' => 'Reason for Visit', 'status' => true, 'view' => 'partials/reports/reasonforvisit-report', 'reportview' => 'partials/scheduledreports/reasonforvisit-report', 'orientation' => 'portrait', 'pageSize' => 'A4'),
        );
    }

    public static function getTimezoneDropDownList()
    {
        return array(
            'Pacific/Midway'       => "(GMT-11:00) Midway Island",
            'US/Samoa'             => "(GMT-11:00) Samoa",
            'US/Hawaii'            => "(GMT-10:00) Hawaii",
            'US/Alaska'            => "(GMT-09:00) Alaska",
            'US/Pacific'           => "(GMT-08:00) Pacific Time (US &amp; Canada)",
            'America/Tijuana'      => "(GMT-08:00) Tijuana",
            'US/Arizona'           => "(GMT-07:00) Arizona",
            'US/Mountain'          => "(GMT-07:00) Mountain Time (US &amp; Canada)",
            'America/Chihuahua'    => "(GMT-07:00) Chihuahua",
            'America/Mazatlan'     => "(GMT-07:00) Mazatlan",
            'America/Mexico_City'  => "(GMT-06:00) Mexico City",
            'America/Monterrey'    => "(GMT-06:00) Monterrey",
            'Canada/Saskatchewan'  => "(GMT-06:00) Saskatchewan",
            'US/Central'           => "(GMT-06:00) Central Time (US &amp; Canada)",
            'US/Eastern'           => "(GMT-05:00) Eastern Time (US &amp; Canada)",
            'US/East-Indiana'      => "(GMT-05:00) Indiana (East)",
            'America/Bogota'       => "(GMT-05:00) Bogota",
            'America/Lima'         => "(GMT-05:00) Lima",
            'America/Caracas'      => "(GMT-04:30) Caracas",
            'Canada/Atlantic'      => "(GMT-04:00) Atlantic Time (Canada)",
            'America/La_Paz'       => "(GMT-04:00) La Paz",
            'America/Santiago'     => "(GMT-04:00) Santiago",
            'Canada/Newfoundland'  => "(GMT-03:30) Newfoundland",
            'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
            'Greenland'            => "(GMT-03:00) Greenland",
            'Atlantic/Stanley'     => "(GMT-02:00) Stanley",
            'Atlantic/Azores'      => "(GMT-01:00) Azores",
            'Atlantic/Cape_Verde'  => "(GMT-01:00) Cape Verde Is.",
            'Africa/Casablanca'    => "(GMT) Casablanca",
            'Europe/Dublin'        => "(GMT) Dublin",
            'Europe/Lisbon'        => "(GMT) Lisbon",
            'Europe/London'        => "(GMT) London",
            'Africa/Monrovia'      => "(GMT) Monrovia",
            'Europe/Amsterdam'     => "(GMT+01:00) Amsterdam",
            'Europe/Belgrade'      => "(GMT+01:00) Belgrade",
            'Europe/Berlin'        => "(GMT+01:00) Berlin",
            'Europe/Bratislava'    => "(GMT+01:00) Bratislava",
            'Europe/Brussels'      => "(GMT+01:00) Brussels",
            'Europe/Budapest'      => "(GMT+01:00) Budapest",
            'Europe/Copenhagen'    => "(GMT+01:00) Copenhagen",
            'Europe/Ljubljana'     => "(GMT+01:00) Ljubljana",
            'Europe/Madrid'        => "(GMT+01:00) Madrid",
            'Europe/Paris'         => "(GMT+01:00) Paris",
            'Europe/Prague'        => "(GMT+01:00) Prague",
            'Europe/Rome'          => "(GMT+01:00) Rome",
            'Europe/Sarajevo'      => "(GMT+01:00) Sarajevo",
            'Europe/Skopje'        => "(GMT+01:00) Skopje",
            'Europe/Stockholm'     => "(GMT+01:00) Stockholm",
            'Europe/Vienna'        => "(GMT+01:00) Vienna",
            'Europe/Warsaw'        => "(GMT+01:00) Warsaw",
            'Europe/Zagreb'        => "(GMT+01:00) Zagreb",
            'Europe/Athens'        => "(GMT+02:00) Athens",
            'Europe/Bucharest'     => "(GMT+02:00) Bucharest",
            'Africa/Cairo'         => "(GMT+02:00) Cairo",
            'Africa/Harare'        => "(GMT+02:00) Harare",
            'Europe/Helsinki'      => "(GMT+02:00) Helsinki",
            'Europe/Istanbul'      => "(GMT+02:00) Istanbul",
            'Asia/Jerusalem'       => "(GMT+02:00) Jerusalem",
            'Europe/Kiev'          => "(GMT+02:00) Kyiv",
            'Europe/Minsk'         => "(GMT+02:00) Minsk",
            'Europe/Riga'          => "(GMT+02:00) Riga",
            'Europe/Sofia'         => "(GMT+02:00) Sofia",
            'Europe/Tallinn'       => "(GMT+02:00) Tallinn",
            'Europe/Vilnius'       => "(GMT+02:00) Vilnius",
            'Asia/Baghdad'         => "(GMT+03:00) Baghdad",
            'Asia/Kuwait'          => "(GMT+03:00) Kuwait",
            'Africa/Nairobi'       => "(GMT+03:00) Nairobi",
            'Asia/Riyadh'          => "(GMT+03:00) Riyadh",
            'Europe/Moscow'        => "(GMT+03:00) Moscow",
            'Asia/Tehran'          => "(GMT+03:30) Tehran",
            'Asia/Baku'            => "(GMT+04:00) Baku",
            'Europe/Volgograd'     => "(GMT+04:00) Volgograd",
            'Asia/Muscat'          => "(GMT+04:00) Muscat",
            'Asia/Tbilisi'         => "(GMT+04:00) Tbilisi",
            'Asia/Yerevan'         => "(GMT+04:00) Yerevan",
            'Asia/Kabul'           => "(GMT+04:30) Kabul",
            'Asia/Karachi'         => "(GMT+05:00) Karachi",
            'Asia/Tashkent'        => "(GMT+05:00) Tashkent",
            'Asia/Kolkata'         => "(GMT+05:30) Kolkata",
            'Asia/Kathmandu'       => "(GMT+05:45) Kathmandu",
            'Asia/Yekaterinburg'   => "(GMT+06:00) Ekaterinburg",
            'Asia/Almaty'          => "(GMT+06:00) Almaty",
            'Asia/Dhaka'           => "(GMT+06:00) Dhaka",
            'Asia/Novosibirsk'     => "(GMT+07:00) Novosibirsk",
            'Asia/Bangkok'         => "(GMT+07:00) Bangkok",
            'Asia/Jakarta'         => "(GMT+07:00) Jakarta",
            'Asia/Krasnoyarsk'     => "(GMT+08:00) Krasnoyarsk",
            'Asia/Chongqing'       => "(GMT+08:00) Chongqing",
            'Asia/Hong_Kong'       => "(GMT+08:00) Hong Kong",
            'Asia/Kuala_Lumpur'    => "(GMT+08:00) Kuala Lumpur",
            'Australia/Perth'      => "(GMT+08:00) Perth",
            'Asia/Singapore'       => "(GMT+08:00) Singapore",
            'Asia/Taipei'          => "(GMT+08:00) Taipei",
            'Asia/Ulaanbaatar'     => "(GMT+08:00) Ulaan Bataar",
            'Asia/Urumqi'          => "(GMT+08:00) Urumqi",
            'Asia/Irkutsk'         => "(GMT+09:00) Irkutsk",
            'Asia/Seoul'           => "(GMT+09:00) Seoul",
            'Asia/Tokyo'           => "(GMT+09:00) Tokyo",
            'Australia/Adelaide'   => "(GMT+09:30) Adelaide",
            'Australia/Darwin'     => "(GMT+09:30) Darwin",
            'Asia/Yakutsk'         => "(GMT+10:00) Yakutsk",
            'Australia/Brisbane'   => "(GMT+10:00) Brisbane",
            'Australia/Canberra'   => "(GMT+10:00) Canberra",
            'Pacific/Guam'         => "(GMT+10:00) Guam",
            'Australia/Hobart'     => "(GMT+10:00) Hobart",
            'Australia/Melbourne'  => "(GMT+10:00) Melbourne",
            'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
            'Australia/Sydney'     => "(GMT+10:00) Sydney",
            'Asia/Vladivostok'     => "(GMT+11:00) Vladivostok",
            'Asia/Magadan'         => "(GMT+12:00) Magadan",
            'Pacific/Auckland'     => "(GMT+12:00) Auckland",
            'Pacific/Fiji'         => "(GMT+12:00) Fiji",
        );
    }

    public static function getPaperSizes()
    {
        return array(
            "4a0" => [0.0, 0.0, 4767.87, 6740.79],
            "2a0" => [0.0, 0.0, 3370.39, 4767.87],
            "a0" => [0.0, 0.0, 2383.94, 3370.39],
            "a1" => [0.0, 0.0, 1683.78, 2383.94],
            "a2" => [0.0, 0.0, 1190.55, 1683.78],
            "a3" => [0.0, 0.0, 841.89, 1190.55],
            "a4" => [0.0, 0.0, 595.28, 841.89],
            "a5" => [0.0, 0.0, 419.53, 595.28],
            "a6" => [0.0, 0.0, 297.64, 419.53],
            "a7" => [0.0, 0.0, 209.76, 297.64],
            "a8" => [0.0, 0.0, 147.40, 209.76],
            "a9" => [0.0, 0.0, 104.88, 147.40],
            "a10" => [0.0, 0.0, 73.70, 104.88],
            "b0" => [0.0, 0.0, 2834.65, 4008.19],
            "b1" => [0.0, 0.0, 2004.09, 2834.65],
            "b2" => [0.0, 0.0, 1417.32, 2004.09],
            "b3" => [0.0, 0.0, 1000.63, 1417.32],
            "b4" => [0.0, 0.0, 708.66, 1000.63],
            "b5" => [0.0, 0.0, 498.90, 708.66],
            "b6" => [0.0, 0.0, 354.33, 498.90],
            "b7" => [0.0, 0.0, 249.45, 354.33],
            "b8" => [0.0, 0.0, 175.75, 249.45],
            "b9" => [0.0, 0.0, 124.72, 175.75],
            "b10" => [0.0, 0.0, 87.87, 124.72],
            "c0" => [0.0, 0.0, 2599.37, 3676.54],
            "c1" => [0.0, 0.0, 1836.85, 2599.37],
            "c2" => [0.0, 0.0, 1298.27, 1836.85],
            "c3" => [0.0, 0.0, 918.43, 1298.27],
            "c4" => [0.0, 0.0, 649.13, 918.43],
            "c5" => [0.0, 0.0, 459.21, 649.13],
            "c6" => [0.0, 0.0, 323.15, 459.21],
            "c7" => [0.0, 0.0, 229.61, 323.15],
            "c8" => [0.0, 0.0, 161.57, 229.61],
            "c9" => [0.0, 0.0, 113.39, 161.57],
            "c10" => [0.0, 0.0, 79.37, 113.39],
            "ra0" => [0.0, 0.0, 2437.80, 3458.27],
            "ra1" => [0.0, 0.0, 1729.13, 2437.80],
            "ra2" => [0.0, 0.0, 1218.90, 1729.13],
            "ra3" => [0.0, 0.0, 864.57, 1218.90],
            "ra4" => [0.0, 0.0, 609.45, 864.57],
            "sra0" => [0.0, 0.0, 2551.18, 3628.35],
            "sra1" => [0.0, 0.0, 1814.17, 2551.18],
            "sra2" => [0.0, 0.0, 1275.59, 1814.17],
            "sra3" => [0.0, 0.0, 907.09, 1275.59],
            "sra4" => [0.0, 0.0, 637.80, 907.09],
            "letter" => [0.0, 0.0, 612.00, 792.00],
            "half-letter" => [0.0, 0.0, 396.00, 612.00],
            "legal" => [0.0, 0.0, 612.00, 1008.00],
            "ledger" => [0.0, 0.0, 1224.00, 792.00],
            "tabloid" => [0.0, 0.0, 792.00, 1224.00],
            "executive" => [0.0, 0.0, 521.86, 756.00],
            "folio" => [0.0, 0.0, 612.00, 936.00],
            "commercial #10 envelope" => [0.0, 0.0, 684.00, 297.00],
            "catalog #10 1/2 envelope" => [0.0, 0.0, 648.00, 864.00],
            "8.5x11" => [0.0, 0.0, 612.00, 792.00],
            "8.5x14" => [0.0, 0.0, 612.00, 1008.00],
            "11x17" => [0.0, 0.0, 792.00, 1224.00]
        );
    }

    public static function getPaperOrientation()
    {
        return array(
            'portrait'       => "portrait",
            'landscape'      => "landscape"
        );
    }

    public static function getScheduledReportTypes()
    {
        return array(
            'one time'    => "One Time",
            'daily'       => "Daily",
            'weekly'      => "Weekly",
            'monthly'     => "Monthly"
        );
    }

    public static function getDayNames()
    {
        return array(
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
        );
    }

    public static function getWeekDays()
    {
        return array(
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
        );
    }

    public static function getShortDayNames()
    {
        return array(
            'Sun',
            'Mon',
            'Tue',
            'Wed',
            'Thu',
            'Fri',
            'Sat',
        );
    }

    public static function getMonthNames()
    {
        return array(
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        );
    }

    public static function getOrdinals()
    {
        return array(
            'First',
            'Second',
            'Third',
            'Fourth',
            'Last'
        );
    }

    public static function getIsOpenStatuses()
    {
        return array(
            'true' => 'Open',
            'false' => 'Closed',
            'all' => 'All Day'
        );
    }
}
