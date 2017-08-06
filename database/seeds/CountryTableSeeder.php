<?php

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('country')->truncate();

        Country::insert([
        	//A
        	['country' => 'Afghanistan'
        	,'slug' => 'afghanistan'],
        	['country' => 'Albania'
        	,'slug' => 'albania'],
        	['country' => 'Algeria'
        	,'slug' => 'algeria'],
        	['country' => 'Andorra'
        	,'slug' => 'andorra'],
        	['country' => 'Angola'
        	,'slug' => 'angola'],
        	['country' => 'Antigua and Barbuda'
        	,'slug' => 'antigua-and-barbuda'],
        	['country' => 'Argentina'
        	,'slug' => 'argentina'],
        	['country' => 'Armenia'
        	,'slug' => 'armenia'],
        	['country' => 'Aruba'
        	,'slug' => 'aruba'],
        	['country' => 'Australia'
        	,'slug' => 'australia'],
        	['country' => 'Austria'
        	,'slug' => 'austria'],
        	['country' => 'Azerbaijan'
        	,'slug' => 'azerbaijan'],
        	//B
        	['country' => 'Bahamas'
        	,'slug' => 'bahamas'],
        	['country' => 'Bahrain'
        	,'slug' => 'bahrain'],
        	['country' => 'Bangladesh'
        	,'slug' => 'bangladesh'],
        	['country' => 'Barbados'
        	,'slug' => 'barbados'],
        	['country' => 'Belarus'
        	,'slug' => 'belarus'],
        	['country' => 'Belgium'
        	,'slug' => 'belgium'],
        	['country' => 'Belize'
        	,'slug' => 'belize'],
        	['country' => 'Benin'
        	,'slug' => 'benin'],
        	['country' => 'Bhutan'
        	,'slug' => 'bhutan'],
        	['country' => 'Bolivia'
        	,'slug' => 'bolivia'],
        	['country' => 'Bosnia and Herzegovina'
        	,'slug' => 'bosnia-and-herzegovina'],
        	['country' => 'Botswana'
        	,'slug' => 'botswana'],
        	['country' => 'Brazil'
        	,'slug' => 'brazil'],
        	['country' => 'Brunei'
        	,'slug' => 'brunei'],
        	['country' => 'Bulgaria'
        	,'slug' => 'bulgaria'],
        	['country' => 'Burkina Faso'
        	,'slug' => 'burkina-faso'],
        	['country' => 'Burma'
        	,'slug' => 'burma'],
        	['country' => 'Burundi'
        	,'slug' => 'burundi'],
        	//C
        	['country' => 'Cambodia'
        	,'slug' => 'cambodia'],
        	['country' => 'Cameroon'
        	,'slug' => 'cameroon'],
        	['country' => 'Canada'
        	,'slug' => 'canada'],
        	['country' => 'Cape Verde'
        	,'slug' => 'cape-verde'],
        	['country' => 'Central African Republic'
        	,'slug' => 'central-african-republic'],
        	['country' => 'Chad'
        	,'slug' => 'chad'],
        	['country' => 'Chile'
        	,'slug' => 'chile'],
        	['country' => 'China'
        	,'slug' => 'china'],
        	['country' => 'Colombia'
        	,'slug' => 'colombia'],
        	['country' => 'Comoros'
        	,'slug' => 'comoros'],
        	['country' => 'Congo, Democratic Republic of the'
        	,'slug' => 'congo-democratic-republic-of-the'],
        	['country' => 'Congo, Republic of the'
        	,'slug' => 'congo-republic-of-the'],
        	['country' => 'Costa Rica'
        	,'slug' => 'costa-rica'],
        	['country' => 'Cote d\'Ivoire'
        	,'slug' => 'cote-d-ivoire'],
        	['country' => 'Croatia'
        	,'slug' => 'croatia'],
        	['country' => 'Cuba'
        	,'slug' => 'cuba'],
        	['country' => 'Curacao'
        	,'slug' => 'curacao'],
        	['country' => 'Czech Republic'
        	,'slug' => 'czech-epublic'],
        	//D
        	['country' => 'Denmark'
        	,'slug' => 'denmark'],
        	['country' => 'Djibouti'
        	,'slug' => 'djibouti'],
        	['country' => 'Dominica'
        	,'slug' => 'dominica'],
        	['country' => 'Dominican Republic'
        	,'slug' => 'dominican-republic'],
        	//E
        	['country' => 'East Timor'
        	,'slug' => 'east-timor'],
        	['country' => 'Ecuador'
        	,'slug' => 'ecuador'],
        	['country' => 'Egypt'
        	,'slug' => 'egypt'],
        	['country' => 'El Salvador'
        	,'slug' => 'el-salvador'],
        	['country' => 'Equatorial Guinea'
        	,'slug' => 'equatorial-guinea'],
        	['country' => 'Eritrea'
        	,'slug' => 'eritrea'],
        	['country' => 'Estonia'
        	,'slug' => 'estonia'],
        	['country' => 'Ethiopia'
        	,'slug' => 'ethiopia'],
        	//F
        	['country' => 'Fiji'
        	,'slug' => 'fiji'],
        	['country' => 'Finland'
        	,'slug' => 'finland'],
        	['country' => 'France'
        	,'slug' => 'france'],
        	['country' => 'Faroe Islands'
        	,'slug' => 'faroe-islands'],
        	//G
        	['country' => 'Gabon'
        	,'slug' => 'gabon'],
        	['country' => 'Gambia, The'
        	,'slug' => 'gambia-the'],
        	['country' => 'Georgia'
        	,'slug' => 'georgia'],
        	['country' => 'Germany'
        	,'slug' => 'germany'],
        	['country' => 'Ghana'
        	,'slug' => 'ghana'],
        	['country' => 'Greece'
        	,'slug' => 'greece'],
        	['country' => 'Grenada'
        	,'slug' => 'grenada'],
        	['country' => 'Guatemala'
        	,'slug' => 'guatemala'],
        	['country' => 'Guinea'
        	,'slug' => 'guinea'],
        	['country' => 'Guinea-Bissau'
        	,'slug' => 'guinea-bissau'],
        	['country' => 'Guyana'
        	,'slug' => 'guyana'],
        	//H
        	['country' => 'Haiti'
        	,'slug' => 'haiti'],
        	['country' => 'Holy See'
        	,'slug' => 'holy-see'],
        	['country' => 'Honduras'
        	,'slug' => 'honduras'],
        	['country' => 'Hong Kong'
        	,'slug' => 'hong-kong'],
        	['country' => 'Hungary'
        	,'slug' => 'hungary'],
        	//I
        	['country' => 'Iceland'
        	,'slug' => 'iceland'],
        	['country' => 'India'
        	,'slug' => 'india'],
        	['country' => 'Indonesia'
        	,'slug' => 'indonesia'],
        	['country' => 'Iran'
        	,'slug' => 'iran'],
        	['country' => 'Iraq'
        	,'slug' => 'iraq'],
        	['country' => 'Ireland'
        	,'slug' => 'ireland'],
        	['country' => 'Israel'
        	,'slug' => 'israel'],
        	['country' => 'Italy'
        	,'slug' => 'italy'],
        	//J
        	['country' => 'Jamaica'
        	,'slug' => 'jamaica'],
        	['country' => 'Japan'
        	,'slug' => 'japan'],
        	['country' => 'Jordan'
        	,'slug' => 'jordan'],
        	//K
        	['country' => 'Kazakhstan'
        	,'slug' => 'kazakhstan'],
        	['country' => 'Kenya'
        	,'slug' => 'kenya'],
        	['country' => 'Kiribati'
        	,'slug' => 'kiribati'],
        	['country' => 'Korea, North'
        	,'slug' => 'korea-north'],
        	['country' => 'Korea, South'
        	,'slug' => 'korea-south'],
        	['country' => 'Kosovo'
        	,'slug' => 'kosovo'],
        	['country' => 'Kuwait'
        	,'slug' => 'kuwait'],
        	['country' => 'Kyrgyzstan'
        	,'slug' => 'kyrgyzstan'],
        	//L
        	['country' => 'Laos'
        	,'slug' => 'laos'],
        	['country' => 'Latvia'
        	,'slug' => 'latvia'],
        	['country' => 'Lebanon'
        	,'slug' => 'lebanon'],
        	['country' => 'Lesotho'
        	,'slug' => 'lesotho'],
        	['country' => 'Liberia'
        	,'slug' => 'liberia'],
        	['country' => 'Libya'
        	,'slug' => 'libya'],
        	['country' => 'Liechtenstein'
        	,'slug' => 'liechtenstein'],
        	['country' => 'Lithuania'
        	,'slug' => 'lithuania'],
        	['country' => 'Luxembourg'
        	,'slug' => 'luxembourg'],
        	//M
        	['country' => 'Macau'
        	,'slug' => 'macau'],
        	['country' => 'Macedonia'
        	,'slug' => 'macedonia'],
        	['country' => 'Madagascar'
        	,'slug' => 'madagascar'],
        	['country' => 'Malawi'
        	,'slug' => 'malawi'],
        	['country' => 'Malaysia'
        	,'slug' => 'malaysia'],
        	['country' => 'Maldives'
        	,'slug' => 'maldives'],
        	['country' => 'Mali'
        	,'slug' => 'mali'],
        	['country' => 'Malta'
        	,'slug' => 'malta'],
        	['country' => 'Marshall Islands'
        	,'slug' => 'marshall-islands'],
        	['country' => 'Mauritania'
        	,'slug' => 'mauritania'],
        	['country' => 'Mauritius'
        	,'slug' => 'mauritius'],
        	['country' => 'Mexico'
        	,'slug' => 'mexico'],
        	['country' => 'Micronesia'
        	,'slug' => 'micronesia'],
        	['country' => 'Monaco'
        	,'slug' => 'monaco'],
        	['country' => 'Mongolia'
        	,'slug' => 'mongolia'],
        	['country' => 'Montenegro'
        	,'slug' => 'montenegro'],
        	['country' => 'Morocco'
        	,'slug' => 'morocco'],
        	['country' => 'Mozambique'
        	,'slug' => 'mozambique'],
        	//N
        	['country' => 'Namibia'
        	,'slug' => 'namibia'],
        	['country' => 'Nauru'
        	,'slug' => 'nauru'],
        	['country' => 'Nepal'
        	,'slug' => 'nepal'],
        	['country' => 'Netherlands'
        	,'slug' => 'netherlands'],
        	['country' => 'Netherlands Antilles'
        	,'slug' => 'netherlands-antilles'],
        	['country' => 'New Zealand'
        	,'slug' => 'new-zealand'],
        	['country' => 'Nicaragua'
        	,'slug' => 'nicaragua'],
        	['country' => 'Niger'
        	,'slug' => 'niger'],
        	['country' => 'Nigeria'
        	,'slug' => 'nigeria'],
        	['country' => 'Norway'
        	,'slug' => 'norway'],
        	//O
        	['country' => 'Oman'
        	,'slug' => 'oman'],
        	//P
        	['country' => 'Pakistan'
        	,'slug' => 'pakistan'],
        	['country' => 'Palau'
        	,'slug' => 'palau'],
        	['country' => 'Palestinian Territories'
        	,'slug' => 'palestinian-territories'],
        	['country' => 'Panama'
        	,'slug' => 'panama'],
        	['country' => 'Papua New Guinea'
        	,'slug' => 'papua-new-guinea'],
        	['country' => 'Paraguay'
        	,'slug' => 'paraguay'],
        	['country' => 'Peru'
        	,'slug' => 'peru'],
        	['country' => 'Philippines'
        	,'slug' => 'philippines'],
        	['country' => 'Poland'
        	,'slug' => 'poland'],
        	['country' => 'Portugal'
        	,'slug' => 'portugal'],
        	//Q
        	['country' => 'Qatar'
        	,'slug' => 'qatar'],
        	//R
        	['country' => 'Romania'
        	,'slug' => 'romania'],
        	['country' => 'Russia'
        	,'slug' => 'russia'],
        	['country' => 'Rwanda'
        	,'slug' => 'rwanda'],
        	//S
        	['country' => 'Saint Kitts and Nevis'
        	,'slug' => 'saint-kitts-and-nevis'],
        	['country' => 'Saint Lucia'
        	,'slug' => 'saint-lucia'],
        	['country' => 'Saint Vincent and the Grenadines'
        	,'slug' => 'saint-vincent-and-the-grenadines'],
        	['country' => 'Samoa'
        	,'slug' => 'samoa'],
        	['country' => 'San Marino'
        	,'slug' => 'san-marino'],
        	['country' => 'Saudi Arabia'
        	,'slug' => 'saudi-arabia'],
        	['country' => 'Senegal'
        	,'slug' => 'senegal'],
        	['country' => 'Serbia'
        	,'slug' => 'serbia'],
        	['country' => 'Seychelles'
        	,'slug' => 'seychelles'],
        	['country' => 'Sierra Leone'
        	,'slug' => 'sierra-leone'],
        	['country' => 'Singapore'
        	,'slug' => 'singapore'],
        	['country' => 'Sint Maarten'
        	,'slug' => 'sint-maarten'],
        	['country' => 'Slovakia'
        	,'slug' => 'slovakia'],
        	['country' => 'Solomon Islands'
        	,'slug' => 'solomon-islands'],
        	['country' => 'Somalia'
        	,'slug' => 'somalia'],
        	['country' => 'South Africa'
        	,'slug' => 'south-africa'],
        	['country' => 'South Sudan'
        	,'slug' => 'south-sudan'],
        	['country' => 'Spain'
        	,'slug' => 'spain'],
        	['country' => 'Sri Lanka'
        	,'slug' => 'sri-lanka'],
        	['country' => 'Sudan'
        	,'slug' => 'sudan'],
        	['country' => 'Suriname'
        	,'slug' => 'suriname'],
        	['country' => 'Swaziland'
        	,'slug' => 'swaziland'],
        	['country' => 'Sweden'
        	,'slug' => 'sweden'],
        	['country' => 'Switzerland'
        	,'slug' => 'switzerland'],
        	['country' => 'Syria'
        	,'slug' => 'syria'],
        	//T
        	['country' => 'Taiwan'
        	,'slug' => 'taiwan'],
        	['country' => 'Tajikistan'
        	,'slug' => 'tajikistan'],
        	['country' => 'Tanzania'
        	,'slug' => 'tanzania'],
        	['country' => 'Thailand'
        	,'slug' => 'thailand'],
        	['country' => 'Timor-Leste'
        	,'slug' => 'timor-leste'],
        	['country' => 'Togo'
        	,'slug' => 'togo'],
        	['country' => 'Tonga'
        	,'slug' => 'tonga'],
        	['country' => 'Trinidad and Tobago'
        	,'slug' => 'trinidad-and-tobago'],
        	['country' => 'Tunisia'
        	,'slug' => 'tunisia'],
        	['country' => 'Turkey'
        	,'slug' => 'turkey'],
        	['country' => 'Turkmenistan'
        	,'slug' => 'turkmenistan'],
        	['country' => 'Tuvalu'
        	,'slug' => 'tuvalu'],
        	//U
        	['country' => 'Uganda'
        	,'slug' => 'uganda'],
        	['country' => 'Ukraine'
        	,'slug' => 'ukraine'],
        	['country' => 'United Arab Emirates'
        	,'slug' => 'united-arab-emirates'],
        	['country' => 'United Kingdom'
        	,'slug' => 'united-kingdom'],
        	['country' => 'United States'
        	,'slug' => 'united-states'],
        	['country' => 'Uruguay'
        	,'slug' => 'uruguay'],
        	['country' => 'Uzbekistan'
        	,'slug' => 'uzbekistan'],
        	//V
        	['country' => 'Vanuatu'
        	,'slug' => 'vanuatu'],
        	['country' => 'Venezuela'
        	,'slug' => 'venezuela'],
        	['country' => 'Vietnam'
        	,'slug' => 'vietnam'],
        	//Y
        	['country' => 'Yemen'
        	,'slug' => 'yemen'],  
        	//Z
        	['country' => 'Zambia'
        	,'slug' => 'zambia'], 
            ['country' => 'Zimbabwe'
            ,'slug' => 'zimbabwe'],
            //missed
            ['country' => 'Greenland'
            ,'slug' => 'greenland'],
            ['country' => 'Moldova, Republic of'
            ,'slug' => 'moldova-republic-of'], 
            ['country' => 'Myanmar'
            ,'slug' => 'myanmar'], 
            ['country' => 'New Caledonia'
            ,'slug' => 'new-caledonia'],
            ['country' => 'Saint Helena'
            ,'slug' => 'saint-helena'],
            ['country' => 'Slovenia'
            ,'slug' => 'slovenia'], 
            ['country' => 'Sao Tome And Principe'
            ,'slug' => 'sao-tome-and-principe'],
        	['country' => 'United States Minor Outlying Islands'
        	,'slug' => 'united-states-minor-outlying-islands'], 
       

        ]);
    }
}
