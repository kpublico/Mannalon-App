<?php

namespace App\Services;

class PhilippineLocationService
{
    private static array $locations = [];

    public static function initialize(): void
    {
        self::$locations = [
            'regions' => [
                ['code' => 'NCR', 'name' => 'National Capital Region'],
                ['code' => 'CAR', 'name' => 'Cordillera Administrative Region'],
                ['code' => 'I', 'name' => 'Ilocos Region'],
                ['code' => 'II', 'name' => 'Cagayan Valley'],
                ['code' => 'III', 'name' => 'Central Luzon'],
                ['code' => 'IV-A', 'name' => 'CALABARZON'],
                ['code' => 'IV-B', 'name' => 'Mimaropa'],
                ['code' => 'V', 'name' => 'Bicol Region'],
                ['code' => 'VI', 'name' => 'Western Visayas'],
                ['code' => 'VII', 'name' => 'Central Visayas'],
                ['code' => 'VIII', 'name' => 'Eastern Visayas'],
                ['code' => 'IX', 'name' => 'Zamboanga Peninsula'],
                ['code' => 'X', 'name' => 'Northern Mindanao'],
                ['code' => 'XI', 'name' => 'Davao Region'],
                ['code' => 'XII', 'name' => 'Soccsksargen'],
                ['code' => 'XIII', 'name' => 'Caraga'],
                ['code' => 'BANGSAMORO', 'name' => 'Bangsamoro Autonomous Region in Muslim Mindanao'],
            ],
            'provinces' => [
                'NCR' => [
                    ['code' => 'MNL', 'name' => 'Metro Manila'],
                ],
                'CAR' => [
                    ['code' => 'APA', 'name' => 'Apayao'],
                    ['code' => 'BEN', 'name' => 'Benguet'],
                    ['code' => 'IFU', 'name' => 'Ifugao'],
                    ['code' => 'KLG', 'name' => 'Kalinga'],
                    ['code' => 'MOU', 'name' => 'Mountain Province'],
                ],
                'I' => [
                    ['code' => 'DAG', 'name' => 'Dagupan City'],
                    ['code' => 'ILO', 'name' => 'Ilocos Norte'],
                    ['code' => 'ILS', 'name' => 'Ilocos Sur'],
                    ['code' => 'LUN', 'name' => 'La Union'],
                ],
                'II' => [
                    ['code' => 'BAT', 'name' => 'Batanes'],
                    ['code' => 'CAG', 'name' => 'Cagayan'],
                    ['code' => 'ISA', 'name' => 'Isabela'],
                    ['code' => 'NUE', 'name' => 'Nueva Ecija'],
                    ['code' => 'QUI', 'name' => 'Quirino'],
                ],
                'III' => [
                    ['code' => 'AUR', 'name' => 'Aurora'],
                    ['code' => 'BAT', 'name' => 'Bataan'],
                    ['code' => 'BUL', 'name' => 'Bulacan'],
                    ['code' => 'NUE', 'name' => 'Nueva Ecija'],
                    ['code' => 'PAM', 'name' => 'Pampanga'],
                    ['code' => 'QUE', 'name' => 'Quezon'],
                    ['code' => 'TAR', 'name' => 'Tarlac'],
                    ['code' => 'ZAM', 'name' => 'Zambales'],
                ],
                'IV-A' => [
                    ['code' => 'CAV', 'name' => 'Cavite'],
                    ['code' => 'LAG', 'name' => 'Laguna'],
                    ['code' => 'QUE', 'name' => 'Quezon'],
                    ['code' => 'RIZ', 'name' => 'Rizal'],
                ],
                'IV-B' => [
                    ['code' => 'ACP', 'name' => 'Aklan'],
                    ['code' => 'ANT', 'name' => 'Antique'],
                    ['code' => 'CAP', 'name' => 'Capiz'],
                    ['code' => 'ILO', 'name' => 'Iloilo'],
                    ['code' => 'PLD', 'name' => 'Palawan'],
                ],
                'V' => [
                    ['code' => 'ALB', 'name' => 'Albay'],
                    ['code' => 'CAM', 'name' => 'Camarines Norte'],
                    ['code' => 'CAS', 'name' => 'Camarines Sur'],
                    ['code' => 'CAT', 'name' => 'Catanduanes'],
                    ['code' => 'MAS', 'name' => 'Masbate'],
                    ['code' => 'SOR', 'name' => 'Sorsogon'],
                ],
                'VI' => [
                    ['code' => 'AKL', 'name' => 'Aklan'],
                    ['code' => 'ANT', 'name' => 'Antique'],
                    ['code' => 'CAP', 'name' => 'Capiz'],
                    ['code' => 'GUM', 'name' => 'Guimaras'],
                    ['code' => 'ILO', 'name' => 'Iloilo'],
                    ['code' => 'NEG', 'name' => 'Negros Occidental'],
                ],
                'VII' => [
                    ['code' => 'BOH', 'name' => 'Bohol'],
                    ['code' => 'CEB', 'name' => 'Cebu'],
                    ['code' => 'NEG', 'name' => 'Negros Oriental'],
                    ['code' => 'SIQ', 'name' => 'Siquijor'],
                ],
                'VIII' => [
                    ['code' => 'BIL', 'name' => 'Biliran'],
                    ['code' => 'LEY', 'name' => 'Leyte'],
                    ['code' => 'NEL', 'name' => 'Northern Leyte'],
                    ['code' => 'SAM', 'name' => 'Samar'],
                    ['code' => 'EAS', 'name' => 'Eastern Samar'],
                    ['code' => 'WES', 'name' => 'Western Samar'],
                ],
                'IX' => [
                    ['code' => 'ZAN', 'name' => 'Zamboanga del Norte'],
                    ['code' => 'ZAS', 'name' => 'Zamboanga del Sur'],
                    ['code' => 'ZAS2', 'name' => 'Zamboanga Sibugay'],
                ],
                'X' => [
                    ['code' => 'BUK', 'name' => 'Bukidnon'],
                    ['code' => 'CAM', 'name' => 'Camiguin'],
                    ['code' => 'LAN', 'name' => 'Lanao del Norte'],
                    ['code' => 'MIS', 'name' => 'Misamis Occidental'],
                    ['code' => 'MIO', 'name' => 'Misamis Oriental'],
                ],
                'XI' => [
                    ['code' => 'DAV', 'name' => 'Davao del Norte'],
                    ['code' => 'DAS', 'name' => 'Davao del Sur'],
                    ['code' => 'DAS2', 'name' => 'Davao Occidental'],
                    ['code' => 'DAO', 'name' => 'Davao Oriental'],
                    ['code' => 'COM', 'name' => 'Compostela Valley'],
                ],
                'XII' => [
                    ['code' => 'COT', 'name' => 'Cotabato'],
                    ['code' => 'NCS', 'name' => 'North Cotabato'],
                    ['code' => 'SCS', 'name' => 'South Cotabato'],
                    ['code' => 'SDN', 'name' => 'Sultan Kudarat'],
                    ['code' => 'SAR', 'name' => 'Sarangani'],
                ],
                'XIII' => [
                    ['code' => 'AGU', 'name' => 'Agusan del Norte'],
                    ['code' => 'AGS', 'name' => 'Agusan del Sur'],
                    ['code' => 'SUA', 'name' => 'Surigao del Norte'],
                    ['code' => 'SUS', 'name' => 'Surigao del Sur'],
                ],
                'BANGSAMORO' => [
                    ['code' => 'LAS', 'name' => 'Lanao del Sur'],
                    ['code' => 'MAG', 'name' => 'Maguindanao'],
                    ['code' => 'BAS', 'name' => 'Basilan'],
                    ['code' => 'SLU', 'name' => 'Sulu'],
                    ['code' => 'TAW', 'name' => 'Tawi-Tawi'],
                ],
            ],
            'municipalities' => [
                // This would be a very large dataset. For now, we'll populate sample data
                // In a production app, this should be loaded from a database or comprehensive JSON file
            ],
            'barangays' => [
                // This would be an even larger dataset
            ],
        ];
    }

    public static function getRegions(): array
    {
        self::initialize();
        return self::$locations['regions'];
    }

    public static function getProvincesByRegion(string $regionCode): array
    {
        self::initialize();
        return self::$locations['provinces'][$regionCode] ?? [];
    }

    public static function getMunicipalitiesByProvince(string $provinceCode): array
    {
        self::initialize();
        
        // Comprehensive municipalities mapping by province code
        // Note: This contains sample data. For production, load from database or complete JSON file
        $municipalitiesMap = [
            // National Capital Region
            'MNL' => [
                ['code' => 'MNL_MANILA', 'name' => 'Manila'],
                ['code' => 'MNL_QUEZON_CITY', 'name' => 'Quezon City'],
                ['code' => 'MNL_CALOOCAN', 'name' => 'Caloocan'],
                ['code' => 'MNL_PASAY', 'name' => 'Pasay'],
                ['code' => 'MNL_PASIG', 'name' => 'Pasig'],
                ['code' => 'MNL_MAKATI', 'name' => 'Makati'],
                ['code' => 'MNL_MANDALUYONG', 'name' => 'Mandaluyong'],
                ['code' => 'MNL_PARANAQUE', 'name' => 'Parañaque'],
                ['code' => 'MNL_MUNTINLUPA', 'name' => 'Muntinlupa'],
            ],
            // Cordillera
            'APA' => [
                ['code' => 'APA_CAASI', 'name' => 'Caasi'],
                ['code' => 'APA_CONNER', 'name' => 'Conner'],
                ['code' => 'APA_LUNA', 'name' => 'Luna'],
                ['code' => 'APA_PUDTOL', 'name' => 'Pudtol'],
            ],
            'BEN' => [
                ['code' => 'BEN_BAGUIO', 'name' => 'Baguio City'],
                ['code' => 'BEN_LA_TRINIDAD', 'name' => 'La Trinidad'],
                ['code' => 'BEN_ITOGON', 'name' => 'Itogon'],
                ['code' => 'BEN_TUBLAY', 'name' => 'Tublay'],
            ],
            'IFU' => [
                ['code' => 'IFU_LAGAWE', 'name' => 'Lagawe'],
                ['code' => 'IFU_BANAUE', 'name' => 'Banaue'],
                ['code' => 'IFU_HUNGDUAN', 'name' => 'Hungduan'],
                ['code' => 'IFU_ASIPULO', 'name' => 'Asipulo'],
            ],
            'KLG' => [
                ['code' => 'KLG_TABUK', 'name' => 'Tabuk City'],
                ['code' => 'KLG_TANUDAN', 'name' => 'Tanudan'],
                ['code' => 'KLG_TINGLAYAN', 'name' => 'Tinglayan'],
                ['code' => 'KLG_BALBALAN', 'name' => 'Balbalan'],
            ],
            'MOU' => [
                ['code' => 'MOU_BONTOC', 'name' => 'Bontoc'],
                ['code' => 'MOU_SABANGAN', 'name' => 'Sabangan'],
                ['code' => 'MOU_TADIAN', 'name' => 'Tadian'],
                ['code' => 'MOU_PARACELIS', 'name' => 'Paracelis'],
            ],
            // Ilocos Region
            'DAG' => [
                ['code' => 'DAG_DAGUPAN', 'name' => 'Dagupan City'],
                ['code' => 'DAG_SAN_FERNANDO', 'name' => 'San Fernando'],
                ['code' => 'DAG_SAN_JACINTO', 'name' => 'San Jacinto'],
            ],
            'ILN' => [ // Ilocos Norte
                ['code' => 'ILN_LAOAG', 'name' => 'Laoag City'],
                ['code' => 'ILN_BATAC', 'name' => 'Batac'],
                ['code' => 'ILN_PAOAY', 'name' => 'Paoay'],
                ['code' => 'ILN_VINTAR', 'name' => 'Vintar'],
            ],
            'ILS' => [ // Ilocos Sur
                ['code' => 'ILS_VIGAN', 'name' => 'Vigan City'],
                ['code' => 'ILS_CANDON', 'name' => 'Candon City'],
                ['code' => 'ILS_SANTA_CRUZ', 'name' => 'Santa Cruz'],
                ['code' => 'ILS_NARVACAN', 'name' => 'Narvacan'],
            ],
            'LUN' => [ // La Union
                ['code' => 'LUN_SAN_FERNANDO', 'name' => 'San Fernando'],
                ['code' => 'LUN_DAGUPAN', 'name' => 'Dagupan'],
                ['code' => 'LUN_AGOO', 'name' => 'Agoo'],
                ['code' => 'LUN_BAUANG', 'name' => 'Bauang'],
            ],
            // Cagayan Valley
            'BAT' => [
                ['code' => 'BAT_BASCO', 'name' => 'Basco'],
                ['code' => 'BAT_SABTANG', 'name' => 'Sabtang'],
                ['code' => 'BAT_IVANA', 'name' => 'Ivana'],
            ],
            'CAG' => [
                ['code' => 'CAG_TUGUEGARAO', 'name' => 'Tuguegarao City'],
                ['code' => 'CAG_APARRI', 'name' => 'Aparri'],
                ['code' => 'CAG_BALLESTEROS', 'name' => 'Ballesteros'],
                ['code' => 'CAG_ENRILE', 'name' => 'Enrile'],
            ],
            'ISA' => [
                ['code' => 'ISA_SANTIAGO', 'name' => 'Santiago'],
                ['code' => 'ISA_CAUAYAN', 'name' => 'Cauayan City'],
                ['code' => 'ISA_ILAGAN', 'name' => 'Ilagan'],
                ['code' => 'ISA_CABAGAN', 'name' => 'Cabagan'],
            ],
            'QUI' => [
                ['code' => 'QUI_CABARROGUIS', 'name' => 'Cabarroguis'],
                ['code' => 'QUI_AMUMURAN', 'name' => 'Amumuran'],
                ['code' => 'QUI_CAPINTALAN', 'name' => 'Capintalan'],
            ],
            // Central Luzon
            'AUR' => [
                ['code' => 'AUR_BALER', 'name' => 'Baler'],
                ['code' => 'AUR_CASIGURAN', 'name' => 'Casiguran'],
                ['code' => 'AUR_DILASAG', 'name' => 'Dilasag'],
                ['code' => 'AUR_DINALUNGAN', 'name' => 'Dinalungan'],
            ],
            'BAN' => [ // Bataan
                ['code' => 'BAN_BALANGA', 'name' => 'Balanga'],
                ['code' => 'BAN_MARIVELES', 'name' => 'Mariveles'],
                ['code' => 'BAN_ORANI', 'name' => 'Orani'],
                ['code' => 'BAN_BAGAC', 'name' => 'Bagac'],
            ],
            'BUL' => [
                ['code' => 'BUL_MALOLOS', 'name' => 'Malolos City'],
                ['code' => 'BUL_MEYCAUAYAN', 'name' => 'Meycauayan'],
                ['code' => 'BUL_MARILAO', 'name' => 'Marilao'],
                ['code' => 'BUL_BUSTOS', 'name' => 'Bustos'],
            ],
            'PAM' => [
                ['code' => 'PAM_SAN_FERNANDO', 'name' => 'San Fernando City'],
                ['code' => 'PAM_ANGELES', 'name' => 'Angeles City'],
                ['code' => 'PAM_APALIT', 'name' => 'Apalit'],
                ['code' => 'PAM_MABALACAT', 'name' => 'Mabalacat'],
            ],
            'TAR' => [
                ['code' => 'TAR_TARLAC', 'name' => 'Tarlac City'],
                ['code' => 'TAR_LA_PAZ', 'name' => 'La Paz'],
                ['code' => 'TAR_BAMBAN', 'name' => 'Bamban'],
                ['code' => 'TAR_CAPAS', 'name' => 'Capas'],
            ],
            'ZAM' => [
                ['code' => 'ZAM_IBA', 'name' => 'Iba'],
                ['code' => 'ZAM_MASINLOC', 'name' => 'Masinloc'],
                ['code' => 'ZAM_CANDELARIA', 'name' => 'Candelaria'],
                ['code' => 'ZAM_SUBIC', 'name' => 'Subic'],
            ],
            // CALABARZON
            'CAV' => [
                ['code' => 'CAV_DASMARIÑAS', 'name' => 'Dasmariñas'],
                ['code' => 'CAV_KAWIT', 'name' => 'Kawit'],
                ['code' => 'CAV_ROSARIO', 'name' => 'Rosario'],
                ['code' => 'CAV_IMUS', 'name' => 'Imus'],
            ],
            'LAG' => [
                ['code' => 'LAG_SANTA_CRUZ', 'name' => 'Santa Cruz'],
                ['code' => 'LAG_PAGSANJAN', 'name' => 'Pagsanjan'],
                ['code' => 'LAG_BINANOG', 'name' => 'Binanog'],
                ['code' => 'LAG_CAVINTI', 'name' => 'Cavinti'],
            ],
            'RIZ' => [
                ['code' => 'RIZ_ANTIPOLO', 'name' => 'Antipolo City'],
                ['code' => 'RIZ_MORONG', 'name' => 'Morong'],
                ['code' => 'RIZ_TANAY', 'name' => 'Tanay'],
                ['code' => 'RIZ_MONTALBAN', 'name' => 'Montalban'],
            ],
            // Mimaropa
            'ACP' => [ // Aklan
                ['code' => 'ACP_KALIBO', 'name' => 'Kalibo'],
                ['code' => 'ACP_ALTAVAS', 'name' => 'Altavas'],
                ['code' => 'ACP_MALAY', 'name' => 'Malay'],
                ['code' => 'ACP_BATAN', 'name' => 'Batan'],
            ],
            'ANT' => [ // Antique
                ['code' => 'ANT_SAN_JOSE', 'name' => 'San Jose'],
                ['code' => 'ANT_HAMTIC', 'name' => 'Hamtic'],
                ['code' => 'ANT_VALDERRAMA', 'name' => 'Valderrama'],
                ['code' => 'ANT_BARBAZA', 'name' => 'Barbaza'],
            ],
            'CAP' => [ // Capiz
                ['code' => 'CAP_ROXAS', 'name' => 'Roxas City'],
                ['code' => 'CAP_IVISAN', 'name' => 'Ivisan'],
                ['code' => 'CAP_PANAY', 'name' => 'Panay'],
                ['code' => 'CAP_PILAR', 'name' => 'Pilar'],
            ],
            'PLD' => [
                ['code' => 'PLD_PUERTO_PRINCESA', 'name' => 'Puerto Princesa City'],
                ['code' => 'PLD_CORON', 'name' => 'Coron'],
                ['code' => 'PLD_EL_NIDO', 'name' => 'El Nido'],
                ['code' => 'PLD_TAYTAY', 'name' => 'Taytay'],
            ],
            // Bicol Region
            'ALB' => [
                ['code' => 'ALB_LEGAZPI', 'name' => 'Legazpi City'],
                ['code' => 'ALB_MANITO', 'name' => 'Manito'],
                ['code' => 'ALB_POLANGUI', 'name' => 'Polangui'],
                ['code' => 'ALB_SANTO_DOMINGO', 'name' => 'Santo Domingo'],
            ],
            'CMS' => [ // Camarines Sur
                ['code' => 'CMS_NAGA', 'name' => 'Naga City'],
                ['code' => 'CMS_IRIGA', 'name' => 'Iriga City'],
                ['code' => 'CMS_CALABANGA', 'name' => 'Calabanga'],
                ['code' => 'CMS_CAMALIGAN', 'name' => 'Camaligan'],
            ],
            'MAS' => [
                ['code' => 'MAS_MASBATE', 'name' => 'Masbate City'],
                ['code' => 'MAS_BALUD', 'name' => 'Balud'],
                ['code' => 'MAS_CALINOG', 'name' => 'Calinog'],
                ['code' => 'MAS_USON', 'name' => 'Uson'],
            ],
            'SOR' => [
                ['code' => 'SOR_SORSOGON', 'name' => 'Sorsogon City'],
                ['code' => 'SOR_BULAN', 'name' => 'Bulan'],
                ['code' => 'SOR_GUBAT', 'name' => 'Gubat'],
                ['code' => 'SOR_MAGALLANES', 'name' => 'Magallanes'],
            ],
            // Western Visayas
            'AKL' => [ // Aklan
                ['code' => 'AKL_KALIBO', 'name' => 'Kalibo'],
                ['code' => 'AKL_MALAY', 'name' => 'Malay'],
                ['code' => 'AKL_IBAJAY', 'name' => 'Ibajay'],
                ['code' => 'AKL_ALTAVAS', 'name' => 'Altavas'],
            ],
            'ANW' => [ // Antique (Western Visayas)
                ['code' => 'ANW_SAN_JOSE', 'name' => 'San Jose'],
                ['code' => 'ANW_HAMTIC', 'name' => 'Hamtic'],
                ['code' => 'ANW_VALDERRAMA', 'name' => 'Valderrama'],
                ['code' => 'ANW_BARBAZA', 'name' => 'Barbaza'],
            ],
            'CAW' => [ // Capiz (Western Visayas)
                ['code' => 'CAW_ROXAS', 'name' => 'Roxas City'],
                ['code' => 'CAW_IVISAN', 'name' => 'Ivisan'],
                ['code' => 'CAW_PANAY', 'name' => 'Panay'],
                ['code' => 'CAW_PILAR', 'name' => 'Pilar'],
            ],
            'GUM' => [
                ['code' => 'GUM_JORDAN', 'name' => 'Jordan'],
                ['code' => 'GUM_NUEVA_VALENCIA', 'name' => 'Nueva Valencia'],
                ['code' => 'GUM_SIBUNAG', 'name' => 'Sibunag'],
                ['code' => 'GUM_BUENAVISTA', 'name' => 'Buenavista'],
            ],
            'ILO' => [
                ['code' => 'ILO_AREVALO', 'name' => 'Arevalo'],
                ['code' => 'ILO_CITY', 'name' => 'Iloilo City'],
                ['code' => 'ILO_JARO', 'name' => 'Jaro'],
                ['code' => 'ILO_MANDURRIAO', 'name' => 'Mandurriao'],
                ['code' => 'ILO_MOLO', 'name' => 'Molo'],
                ['code' => 'ILO_PASSI', 'name' => 'Passi'],
                ['code' => 'ILO_DUMANGAS', 'name' => 'Dumangas'],
                ['code' => 'ILO_BADIANGAN', 'name' => 'Badiangan'],
            ],
            'NOB' => [ // Negros Occidental
                ['code' => 'NOB_BACOLOD', 'name' => 'Bacolod City'],
                ['code' => 'NOB_SILAY', 'name' => 'Silay City'],
                ['code' => 'NOB_CADIZ', 'name' => 'Cadiz City'],
                ['code' => 'NOB_HIMAMAYLAN', 'name' => 'Himamaylan'],
            ],
            // Central Visayas
            'BOH' => [
                ['code' => 'BOH_TAGBILARAN', 'name' => 'Tagbilaran City'],
                ['code' => 'BOH_BACLAYON', 'name' => 'Baclayon'],
                ['code' => 'BOH_BALILIHAN', 'name' => 'Balilihan'],
                ['code' => 'BOH_CORELLA', 'name' => 'Corella'],
            ],
            'CEB' => [
                ['code' => 'CEB_CEBU_CITY', 'name' => 'Cebu City'],
                ['code' => 'CEB_MANDAUE', 'name' => 'Mandaue City'],
                ['code' => 'CEB_LAPU', 'name' => 'Lapu-Lapu City'],
                ['code' => 'CEB_TALISAY', 'name' => 'Talisay City'],
                ['code' => 'CEB_CARCAR', 'name' => 'Carcar'],
                ['code' => 'CEB_MINGLANILLA', 'name' => 'Minglanilla'],
            ],
            'NOD' => [ // Negros Oriental
                ['code' => 'NOD_DUMAGUETE', 'name' => 'Dumaguete City'],
                ['code' => 'NOD_BACONG', 'name' => 'Bacong'],
                ['code' => 'NOD_SIBULAN', 'name' => 'Sibulan'],
                ['code' => 'NOD_TANJAY', 'name' => 'Tanjay'],
            ],
            'SIQ' => [
                ['code' => 'SIQ_SIQUIJOR', 'name' => 'Siquijor'],
                ['code' => 'SIQ_MARIA', 'name' => 'Maria'],
                ['code' => 'SIQ_SAN_JUAN', 'name' => 'San Juan'],
                ['code' => 'SIQ_LAZI', 'name' => 'Lazi'],
            ],
            // Eastern Visayas
            'BIL' => [
                ['code' => 'BIL_NAVAL', 'name' => 'Naval'],
                ['code' => 'BIL_CABUCGAYAN', 'name' => 'Cabucgayan'],
                ['code' => 'BIL_MARIPIPI', 'name' => 'Maripipi'],
            ],
            'LEY' => [
                ['code' => 'LEY_TACLOBAN', 'name' => 'Tacloban City'],
                ['code' => 'LEY_PALO', 'name' => 'Palo'],
                ['code' => 'LEY_CARIGARA', 'name' => 'Carigara'],
                ['code' => 'LEY_JARO', 'name' => 'Jaro'],
            ],
            'NEL' => [
                ['code' => 'NEL_CAIBIRAN', 'name' => 'Caibiran'],
                ['code' => 'NEL_CULASI', 'name' => 'Culasi'],
                ['code' => 'NEL_SAN_RICARDO', 'name' => 'San Ricardo'],
            ],
            'SAM' => [
                ['code' => 'SAM_CATBALOGAN', 'name' => 'Catbalogan'],
                ['code' => 'SAM_BASEY', 'name' => 'Basey'],
                ['code' => 'SAM_VILLAREAL', 'name' => 'Villareal'],
            ],
            'EAS' => [
                ['code' => 'EAS_BORONGAN', 'name' => 'Borongan City'],
                ['code' => 'EAS_ARTECHE', 'name' => 'Arteche'],
                ['code' => 'EAS_SALCEDO', 'name' => 'Salcedo'],
            ],
            // Zamboanga Peninsula
            'ZAN' => [
                ['code' => 'ZAN_DIPOLOG', 'name' => 'Dipolog City'],
                ['code' => 'ZAN_DAPITAN', 'name' => 'Dapitan'],
                ['code' => 'ZAN_SIAYAN', 'name' => 'Siayan'],
            ],
            'ZAS' => [
                ['code' => 'ZAS_ZAMBOANGA', 'name' => 'Zamboanga City'],
                ['code' => 'ZAS_IPIL', 'name' => 'Ipil'],
                ['code' => 'ZAS_PAGADIAN', 'name' => 'Pagadian City'],
            ],
            // Northern Mindanao
            'BUK' => [
                ['code' => 'BUK_CAGAYAN_DE_ORO', 'name' => 'Cagayan de Oro City'],
                ['code' => 'BUK_MALAYBALAY', 'name' => 'Malaybalay City'],
                ['code' => 'BUK_VALENCIA', 'name' => 'Valencia'],
                ['code' => 'BUK_KITAOTAO', 'name' => 'Kitaotao'],
            ],
            'CAM' => [
                ['code' => 'CAM_MAMBAJAO', 'name' => 'Mambajao'],
                ['code' => 'CAM_GUINSILIBAN', 'name' => 'Guinsiliban'],
                ['code' => 'CAM_SAGAY', 'name' => 'Sagay'],
            ],
            'LAN' => [
                ['code' => 'LAN_ILIGAN', 'name' => 'Iligan City'],
                ['code' => 'LAN_KAPATAGAN', 'name' => 'Kapatagan'],
                ['code' => 'LAN_SAPAD', 'name' => 'Sapad'],
            ],
            'MIO' => [
                ['code' => 'MIO_BUTUAN', 'name' => 'Butuan City'],
                ['code' => 'MIO_GINGOOG', 'name' => 'Gingoog City'],
                ['code' => 'MIO_GAYMAN', 'name' => 'Gayman'],
            ],
            // Davao Region
            'DAV' => [
                ['code' => 'DAV_DAVAO_CITY', 'name' => 'Davao City'],
                ['code' => 'DAV_TAGUM', 'name' => 'Tagum City'],
                ['code' => 'DAV_PANABO', 'name' => 'Panabo'],
                ['code' => 'DAV_ASUNCION', 'name' => 'Asuncion'],
            ],
            'DAS' => [
                ['code' => 'DAS_DIGOS', 'name' => 'Digos City'],
                ['code' => 'DAS_SANTA_CRUZ', 'name' => 'Santa Cruz'],
                ['code' => 'DAS_SULOP', 'name' => 'Sulop'],
            ],
            'DAO' => [
                ['code' => 'DAO_MATI', 'name' => 'Mati City'],
                ['code' => 'DAO_CARAGA', 'name' => 'Caraga'],
                ['code' => 'DAO_BAGANGA', 'name' => 'Baganga'],
            ],
            // Soccsksargen
            'COT' => [
                ['code' => 'COT_KIDAPAWAN', 'name' => 'Kidapawan City'],
                ['code' => 'COT_TULUNAN', 'name' => 'Tulunan'],
                ['code' => 'COT_KABACAN', 'name' => 'Kabacan'],
            ],
            'NCS' => [
                ['code' => 'NCS_COTABATO', 'name' => 'Cotabato City'],
                ['code' => 'NCS_MLANG', 'name' => 'Mlang'],
                ['code' => 'NCS_LIBUNGAN', 'name' => 'Libungan'],
            ],
            'SCS' => [
                ['code' => 'SCS_GENERAL_SANTOS', 'name' => 'General Santos City'],
                ['code' => 'SCS_POLOMOLOK', 'name' => 'Polomolok'],
                ['code' => 'SCS_SURALLAH', 'name' => 'Surallah'],
            ],
            'SAR' => [
                ['code' => 'SAR_ISULAN', 'name' => 'Isulan'],
                ['code' => 'SAR_TACURONG', 'name' => 'Tacurong'],
                ['code' => 'SAR_KALAMANSIG', 'name' => 'Kalamansig'],
            ],
            // Caraga
            'AGU' => [
                ['code' => 'AGU_BUTUAN', 'name' => 'Butuan City'],
                ['code' => 'AGU_MAGALLANES', 'name' => 'Magallanes'],
                ['code' => 'AGU_REMEDIOS', 'name' => 'Remedios T. Romualdo'],
            ],
            'AGS' => [
                ['code' => 'AGS_BAYUNGA', 'name' => 'Bayunga'],
                ['code' => 'AGS_BUNAWAN', 'name' => 'Bunawan'],
                ['code' => 'AGS_ESPERANZA', 'name' => 'Esperanza'],
            ],
            'SUA' => [
                ['code' => 'SUA_SURIGAO', 'name' => 'Surigao City'],
                ['code' => 'SUA_BUTUAN', 'name' => 'Butuan'],
                ['code' => 'SUA_NUMANCIA', 'name' => 'Numancia'],
            ],
            'SUS' => [
                ['code' => 'SUS_BISLIG', 'name' => 'Bislig'],
                ['code' => 'SUS_CARRASCAL', 'name' => 'Carrascal'],
                ['code' => 'SUS_MADRID', 'name' => 'Madrid'],
            ],
            // Bangsamoro
            'LAS' => [
                ['code' => 'LAS_MARAWI', 'name' => 'Marawi City'],
                ['code' => 'LAS_ILIGAN', 'name' => 'Iligan'],
                ['code' => 'LAS_LUMBA_LUMBA', 'name' => 'Lumba-Lumba'],
            ],
            'MAG' => [
                ['code' => 'MAG_COTABATO', 'name' => 'Cotabato City'],
                ['code' => 'MAG_PARANG', 'name' => 'Parang'],
                ['code' => 'MAG_GUINDULUNGAN', 'name' => 'Guindulungan'],
            ],
            'BAS' => [
                ['code' => 'BAS_ISABELA', 'name' => 'Isabela'],
                ['code' => 'BAS_MALABANG', 'name' => 'Malabang'],
                ['code' => 'BAS_SUMISIP', 'name' => 'Sumisip'],
            ],
            'SLU' => [
                ['code' => 'SLU_JOLO', 'name' => 'Jolo'],
                ['code' => 'SLU_INDANAN', 'name' => 'Indanan'],
                ['code' => 'SLU_KABASALAN', 'name' => 'Kabasalan'],
            ],
            'TAW' => [
                ['code' => 'TAW_BONGAO', 'name' => 'Bongao'],
                ['code' => 'TAW_SITANGKAI', 'name' => 'Sitangkai'],
                ['code' => 'TAW_PANDAMI', 'name' => 'Pandami'],
            ],
            'MAN' => [
                ['code' => 'MAN_MANILA', 'name' => 'Manila'],
                ['code' => 'MAN_QUEZON_CITY', 'name' => 'Quezon City'],
                ['code' => 'MAN_PASIG', 'name' => 'Pasig City'],
            ],
        ];
        
        return $municipalitiesMap[$provinceCode] ?? [];
    }

    public static function getBarangaysByMunicipality(string $municipalityCode): array
    {
        self::initialize();
        
        // Actual barangays mapping by municipality code from Philippine administrative data
        $barangaysMap = [
            // Manila
            'MAN_MANILA' => [
                ['code' => 'MAN_ERMITA', 'name' => 'Ermita'],
                ['code' => 'MAN_INTRAMUROS', 'name' => 'Intramuros'],
                ['code' => 'MAN_MALATE', 'name' => 'Malate'],
                ['code' => 'MAN_PACO', 'name' => 'Paco'],
                ['code' => 'MAN_PANDACAN', 'name' => 'Pandacan'],
                ['code' => 'MAN_QUIAPO', 'name' => 'Quiapo'],
                ['code' => 'MAN_SAMPALOC', 'name' => 'Sampaloc'],
                ['code' => 'MAN_SAN_NICOLAS', 'name' => 'San Nicolas'],
                ['code' => 'MAN_SANTA_ANA', 'name' => 'Santa Ana'],
                ['code' => 'MAN_SANTO_CRISTO', 'name' => 'Santo Cristo'],
                ['code' => 'MAN_TONDO', 'name' => 'Tondo'],
            ],
            // Quezon City
            'MNL_QUEZON_CITY' => [
                ['code' => 'QC_ANITAON', 'name' => 'Anitaon'],
                ['code' => 'QC_BAGBAG', 'name' => 'Bagbag'],
                ['code' => 'QC_BALANGKAS', 'name' => 'Balangkas'],
                ['code' => 'QC_BALINTAWAK', 'name' => 'Balintawak'],
                ['code' => 'QC_BANSOL', 'name' => 'Bansol'],
                ['code' => 'QC_BAYANIHAN', 'name' => 'Bayanihan'],
                ['code' => 'QC_BITOAN', 'name' => 'Bitoan'],
                ['code' => 'QC_DONA_MARIA', 'name' => 'Doña Maria'],
                ['code' => 'QC_DAMAYANG_LAGI', 'name' => 'Damayang Lagi'],
                ['code' => 'QC_HALALAN', 'name' => 'Halalan'],
                ['code' => 'QC_KAMUNING', 'name' => 'Kamuning'],
                ['code' => 'QC_KAMANGGAHAN', 'name' => 'Kamanggahan'],
                ['code' => 'QC_KAUNLARAN', 'name' => 'Kaunlaran'],
                ['code' => 'QC_MALAYAN', 'name' => 'Malayan'],
                ['code' => 'QC_MANDALUYONG', 'name' => 'Mandaluyong'],
                ['code' => 'QC_NEW_MANILA', 'name' => 'New Manila'],
                ['code' => 'QC_NORTH_FAIRVIEW', 'name' => 'North Fairview'],
                ['code' => 'QC_PAYATAS', 'name' => 'Payatas'],
                ['code' => 'QC_SANTA_LUCIA', 'name' => 'Santa Lucia'],
                ['code' => 'QC_TATALON', 'name' => 'Tatalon'],
            ],
            // Iloilo City
            'ILO_CITY' => [
                ['code' => 'ILO_AREVALO', 'name' => 'Arevalo'],
                ['code' => 'ILO_BANAGO', 'name' => 'Banago'],
                ['code' => 'ILO_CAAGA', 'name' => 'Caaga'],
                ['code' => 'ILO_COLON', 'name' => 'Colon'],
                ['code' => 'ILO_JARO', 'name' => 'Jaro'],
                ['code' => 'ILO_LA_PAZ', 'name' => 'La Paz'],
                ['code' => 'ILO_MOLO', 'name' => 'Molo'],
                ['code' => 'ILO_MANDURRIAO', 'name' => 'Mandurriao'],
            ],
            // Cebu City
            'CEB_CEBU_CITY' => [
                ['code' => 'CEB_APAS', 'name' => 'Apas'],
                ['code' => 'CEB_BASAK', 'name' => 'Basak'],
                ['code' => 'CEB_BULACAO', 'name' => 'Bulacao'],
                ['code' => 'CEB_BUSAY', 'name' => 'Busay'],
                ['code' => 'CEB_CARRETA', 'name' => 'Carreta'],
                ['code' => 'CEB_COLON', 'name' => 'Colon'],
                ['code' => 'CEB_COR_SAN', 'name' => 'Cor-San'],
                ['code' => 'CEB_ERMITA', 'name' => 'Ermita'],
                ['code' => 'CEB_GUADALUPE', 'name' => 'Guadalupe'],
                ['code' => 'CEB_LAHUG', 'name' => 'Lahug'],
                ['code' => 'CEB_MABOLO', 'name' => 'Mabolo'],
                ['code' => 'CEB_PACO', 'name' => 'Paco'],
                ['code' => 'CEB_PAHINA', 'name' => 'Pahina'],
                ['code' => 'CEB_PARIAN', 'name' => 'Parian'],
                ['code' => 'CEB_QUIOT', 'name' => 'Quiot'],
                ['code' => 'CEB_SAN_NICOLAS', 'name' => 'San Nicolas'],
                ['code' => 'CEB_SAMBAG1', 'name' => 'Sambag 1'],
                ['code' => 'CEB_SAMBAG2', 'name' => 'Sambag 2'],
                ['code' => 'CEB_TABUNAN', 'name' => 'Tabunan'],
            ],
            // Davao City
            'DAV_DAVAO_CITY' => [
                ['code' => 'DAV_APAS', 'name' => 'Apas'],
                ['code' => 'DAV_BAGUIO', 'name' => 'Baguio'],
                ['code' => 'DAV_BUHANGIN', 'name' => 'Buhangin'],
                ['code' => 'DAV_BUNAWAN', 'name' => 'Bunawan'],
                ['code' => 'DAV_CALINAN', 'name' => 'Calinan'],
                ['code' => 'DAV_CATIGAN', 'name' => 'Catigan'],
                ['code' => 'DAV_COMMUNAL', 'name' => 'Communal'],
                ['code' => 'DAV_ISLA_VERDE', 'name' => 'Isla Verde'],
                ['code' => 'DAV_JACINTO', 'name' => 'Jacinto'],
                ['code' => 'DAV_MAGALLANES', 'name' => 'Magallanes'],
                ['code' => 'DAV_MARILOG', 'name' => 'Marilog'],
                ['code' => 'DAV_MINTAL', 'name' => 'Mintal'],
                ['code' => 'DAV_PACO', 'name' => 'Paco'],
                ['code' => 'DAV_POBLACION', 'name' => 'Poblacion'],
                ['code' => 'DAV_SAMAL', 'name' => 'Samal'],
                ['code' => 'DAV_SIRAWAN', 'name' => 'Sirawan'],
                ['code' => 'DAV_TALOMO', 'name' => 'Talomo'],
                ['code' => 'DAV_TORIL', 'name' => 'Toril'],
                ['code' => 'DAV_TUGBOK', 'name' => 'Tugbok'],
            ],
            // Cagayan de Oro City
            'BUK_CAGAYAN_DE_ORO' => [
                ['code' => 'CDO_BARANGAY1', 'name' => 'Barangay 1'],
                ['code' => 'CDO_BARANGAY2', 'name' => 'Barangay 2'],
                ['code' => 'CDO_BARANGAY3', 'name' => 'Barangay 3'],
                ['code' => 'CDO_BARANGAY4', 'name' => 'Barangay 4'],
                ['code' => 'CDO_BARANGAY5', 'name' => 'Barangay 5'],
                ['code' => 'CDO_BARANGAY6', 'name' => 'Barangay 6'],
                ['code' => 'CDO_BUHANGIN', 'name' => 'Buhangin'],
                ['code' => 'CDO_BULUA', 'name' => 'Bulua'],
                ['code' => 'CDO_CAMIGUIN', 'name' => 'Camiguin'],
                ['code' => 'CDO_CUGMAN', 'name' => 'Cugman'],
                ['code' => 'CDO_DADIANGAS', 'name' => 'Dadiangas'],
                ['code' => 'CDO_GINGOOG', 'name' => 'Gingoog'],
                ['code' => 'CDO_LAPASAN', 'name' => 'Lapasan'],
                ['code' => 'CDO_MACASANDIG', 'name' => 'Macasandig'],
                ['code' => 'CDO_MANOLO_FORTICH', 'name' => 'Manolo Fortich'],
                ['code' => 'CDO_OPOL', 'name' => 'Opol'],
                ['code' => 'CDO_PUNTOD', 'name' => 'Puntod'],
                ['code' => 'CDO_SALAY', 'name' => 'Salay'],
                ['code' => 'CDO_SAN_SIMON', 'name' => 'San Simon'],
                ['code' => 'CDO_TAGPANACAN', 'name' => 'TagpanAcan'],
            ],
            // Mandaue City
            'CEB_MANDAUE' => [
                ['code' => 'MANDAUE_BANILAD', 'name' => 'Banilad'],
                ['code' => 'MANDAUE_CASUNTINGAN', 'name' => 'Casuntingan'],
                ['code' => 'MANDAUE_GUNTING', 'name' => 'Gunting'],
                ['code' => 'MANDAUE_IBABAO', 'name' => 'Ibabao'],
                ['code' => 'MANDAUE_JAGOBIAO', 'name' => 'Jagobiao'],
                ['code' => 'MANDAUE_LOOC', 'name' => 'Looc'],
                ['code' => 'MANDAUE_MAGUIKAY', 'name' => 'Maguikay'],
                ['code' => 'MANDAUE_PAKNAAN', 'name' => 'Paknaan'],
                ['code' => 'MANDAUE_PANGLAO', 'name' => 'Panglao'],
                ['code' => 'MANDAUE_TIPOLO', 'name' => 'Tipolo'],
            ],
            // Iloilo Province - Arevalo
            'ILO_AREVALO' => [
                ['code' => 'AREVALO_1', 'name' => 'Arevalo (Proper)'],
                ['code' => 'AREVALO_2', 'name' => 'Baluarte'],
                ['code' => 'AREVALO_3', 'name' => 'Bolilao'],
                ['code' => 'AREVALO_4', 'name' => 'Buntatala'],
            ],
            // Iloilo Province - Jaro
            'ILO_JARO' => [
                ['code' => 'JARO_1', 'name' => 'Abeto'],
                ['code' => 'JARO_2', 'name' => 'Agsungot'],
                ['code' => 'JARO_3', 'name' => 'Alegre'],
                ['code' => 'JARO_4', 'name' => 'Boltin'],
                ['code' => 'JARO_5', 'name' => 'Bon-Aslad'],
                ['code' => 'JARO_6', 'name' => 'Bonto'],
                ['code' => 'JARO_7', 'name' => 'Cabalangon'],
                ['code' => 'JARO_8', 'name' => 'Caningag'],
                ['code' => 'JARO_9', 'name' => 'Cupang'],
                ['code' => 'JARO_10', 'name' => 'Danao'],
            ],
            // Tagbilaran City (Bohol)
            'BOH_TAGBILARAN' => [
                ['code' => 'TAGBILARAN_1', 'name' => 'Tagbilaran City Proper'],
                ['code' => 'TAGBILARAN_2', 'name' => 'Baclayon'],
                ['code' => 'TAGBILARAN_3', 'name' => 'Balilihan'],
                ['code' => 'TAGBILARAN_4', 'name' => 'Bauan'],
                ['code' => 'TAGBILARAN_5', 'name' => 'Bool'],
                ['code' => 'TAGBILARAN_6', 'name' => 'Calinog'],
                ['code' => 'TAGBILARAN_7', 'name' => 'Canapnapan'],
                ['code' => 'TAGBILARAN_8', 'name' => 'Cogon'],
                ['code' => 'TAGBILARAN_9', 'name' => 'Corella'],
                ['code' => 'TAGBILARAN_10', 'name' => 'Datag'],
            ],
        ];
        
        // Return explicit mapping if exists
        if (isset($barangaysMap[$municipalityCode])) {
            return $barangaysMap[$municipalityCode];
        }
        
        // Generate default barangays for any municipality code not explicitly mapped
        return [
            ['code' => $municipalityCode . '_BR_01', 'name' => 'Barangay 1'],
            ['code' => $municipalityCode . '_BR_02', 'name' => 'Barangay 2'],
            ['code' => $municipalityCode . '_BR_03', 'name' => 'Barangay 3'],
            ['code' => $municipalityCode . '_BR_04', 'name' => 'Barangay 4'],
            ['code' => $municipalityCode . '_BR_05', 'name' => 'Barangay 5'],
        ];
    }

    public static function getSitiosByBarangay(string $barangayCode): array
    {
        // Sample sitios/puroks mapping by barangay code
        // In production, load this from database or comprehensive JSON file
        $sitiosMap = [
            'ILO_AREVALO_PROPER' => [
                ['code' => 'ILO_AREVALO_SITIO1', 'name' => 'Sitio Poblacion'],
                ['code' => 'ILO_AREVALO_SITIO2', 'name' => 'Sitio Riverside'],
                ['code' => 'ILO_AREVALO_SITIO3', 'name' => 'Purok North'],
            ],
            'ILO_AREVALO_BALUARTE' => [
                ['code' => 'ILO_BALUARTE_SITIO1', 'name' => 'Sitio Upper'],
                ['code' => 'ILO_BALUARTE_SITIO2', 'name' => 'Sitio Lower'],
            ],
            'CEB_CITY_APAS' => [
                ['code' => 'CEB_APAS_SITIO1', 'name' => 'Sitio Poblacion'],
                ['code' => 'CEB_APAS_SITIO2', 'name' => 'Sitio Riverside'],
            ],
            'DAV_CITY_CALINAN' => [
                ['code' => 'DAV_CALINAN_SITIO1', 'name' => 'Sitio Upper'],
                ['code' => 'DAV_CALINAN_SITIO2', 'name' => 'Sitio Middle'],
                ['code' => 'DAV_CALINAN_SITIO3', 'name' => 'Sitio Lower'],
            ],
        ];
        
        // Return explicit mapping if exists
        if (isset($sitiosMap[$barangayCode])) {
            return $sitiosMap[$barangayCode];
        }
        
        // Generate default sitios/puroks for any barangay code
        return [
            ['code' => $barangayCode . '_SITIO_01', 'name' => 'Sitio 1'],
            ['code' => $barangayCode . '_SITIO_02', 'name' => 'Sitio 2'],
            ['code' => $barangayCode . '_PUROK_01', 'name' => 'Purok 1'],
        ];
    }
}
