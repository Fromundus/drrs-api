<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        //COLLEGES

        \App\Models\College::factory()->create([
            "name" => "College of Engineering and Architecture",
            "college_code" => "CEA"
        ]);

        \App\Models\College::factory()->create([
            "name" => "College of Sciences",
            "college_code" => "COS"
        ]);

        \App\Models\College::factory()->create([
            "name" => "College of Humanities and Social Science",
            "college_code" => "CHUMSS"
        ]);

        \App\Models\College::factory()->create([
            "name" => "College of Business and Accountancy",
            "college_code" => "CBA"
        ]);

        \App\Models\College::factory()->create([
            "name" => "College of Health Sciences",
            "college_code" => "CHS"
        ]);

        \App\Models\College::factory()->create([
            "name" => "College of Industrial Technology",
            "college_code" => "CIT"
        ]);

        \App\Models\College::factory()->create([
            "name" => "College of Agriculture and Fisheries",
            "college_code" => "CAF"
        ]);

        \App\Models\College::factory()->create([
            "name" => "College of Education",
            "college_code" => "COED"
        ]);

        \App\Models\College::factory()->create([
            "name" => "College of Information and Communications Technology",
            "college_code" => "CICT"
        ]);

        //PROGRAMS

        //CEA

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Civil Engineering",
            "program_code" => "BSCE",
            "college_code" => "CEA"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Computer Engineering",
            "program_code" => "BSCPE",
            "college_code" => "CEA"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Electronics & Communication Engineering",
            "program_code" => "BSECE",
            "college_code" => "CEA"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Architecture",
            "program_code" => "BSArchi",
            "college_code" => "CEA"
        ]);

        //COS

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Biology",
            "program_code" => "BSBio",
            "college_code" => "COS"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Environmental Science",
            "program_code" => "BSES",
            "college_code" => "COS"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Mathematics",
            "program_code" => "BSMath",
            "college_code" => "COS"
        ]);

        //CHUMSS

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Arts in Political Science",
            "program_code" => "BAPolSci",
            "college_code" => "CHUMSS"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Arts in Economics",
            "program_code" => "BAEconomics",
            "college_code" => "CHUMSS"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Public Administration",
            "program_code" => "BPA",
            "college_code" => "CHUMSS"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Arts in English Language",
            "program_code" => "BAEL",
            "college_code" => "CHUMSS"
        ]);

        //CBA

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Accountancy",
            "program_code" => "BSAccountancy",
            "college_code" => "CBA"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Accounting Information System",
            "program_code" => "BSAIS",
            "college_code" => "CBA"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Business Administration",
            "program_code" => "BSBA",
            "college_code" => "CBA"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Entrepreneurship",
            "program_code" => "BSEntrep",
            "college_code" => "CBA"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Internal Auditing",
            "program_code" => "BSIA",
            "college_code" => "CBA"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Office Administration",
            "program_code" => "BSOA",
            "college_code" => "CBA"
        ]);

        //CHS

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Nursing",
            "program_code" => "BSN",
            "college_code" => "CHS"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Nutrition and Dietetics",
            "program_code" => "BSND",
            "college_code" => "CHS"
        ]);

        //CIT

        \App\Models\Program::factory()->create([
            "name" => "Laddered Bachelor of Science in Industrial Technology",
            "program_code" => "LBSIT",
            "college_code" => "CIT"
        ]);

        //CAF

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Agriculture",
            "program_code" => "BSAgri",
            "college_code" => "CAF"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Agri-Business",
            "program_code" => "BSAB",
            "college_code" => "CAF"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Fisheries",
            "program_code" => "BSF",
            "college_code" => "CAF"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Certificate in Agricultural Science",
            "program_code" => "CAS",
            "college_code" => "CAF"
        ]);

        //COED

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Elementary Education",
            "program_code" => "BEEd",
            "college_code" => "COED"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Secondary Education",
            "program_code" => "BSEd",
            "college_code" => "COED"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Technical-Vocational Teacher Education",
            "program_code" => "BTVTEd",
            "college_code" => "COED"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Culture and Arts Education",
            "program_code" => "BCAE",
            "college_code" => "COED"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Physical Education",
            "program_code" => "BPEd",
            "college_code" => "COED"
        ]);

        //CICT

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Information Systems",
            "program_code" => "BSIS",
            "college_code" => "CICT"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Information Technology",
            "program_code" => "BSIT",
            "college_code" => "CICT"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Computer Science",
            "program_code" => "BSCS",
            "college_code" => "CICT"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Science in Entertainment and Multimedia Computing",
            "program_code" => "BSEMC",
            "college_code" => "CICT"
        ]);

        \App\Models\Program::factory()->create([
            "name" => "Bachelor of Library in Information Science",
            "program_code" => "BLIS",
            "college_code" => "CICT"
        ]);



        //SERVICES

        \App\Models\Service::factory()->create([
            'service_code' => 'TOR',
            'name' => 'Transcript of Records',
            'img' => 'https://cdn-icons-png.flaticon.com/128/3197/3197918.png',
            'clearance' => 'required',
            'price' => 150,
            'processing_days' => 3
        ]);

        \App\Models\Service::factory()->create([
            'service_code' => 'COG',
            'name' => 'Certificate of Grades',
            'img' => 'https://cdn-icons-png.flaticon.com/128/9072/9072148.png',
            'clearance' => 'not',
            'price' => 50,
            'processing_days' => 1
        ]);
        
        \App\Models\Service::factory()->create([
            'service_code' => 'DIPLOMA',
            'name' => 'Diploma',
            'img' => 'https://cdn-icons-png.flaticon.com/128/2231/2231605.png',
            'clearance' => 'required',
            'price' => 150,
            'processing_days' => 3
        ]);

        \App\Models\Service::factory()->create([
            'service_code' => 'CBFS',
            'name' => 'Certification as a Bona Fide Student',
            'img' => 'https://cdn-icons-png.flaticon.com/128/3938/3938377.png',
            'clearance' => 'not',
            'price' => 30,
            'processing_days' => 1
        ]);

        \App\Models\Service::factory()->create([
            'service_code' => 'TC',
            'name' => 'Transfer Credentials',
            'img' => 'https://cdn-icons-png.flaticon.com/128/4010/4010790.png',
            'clearance' => 'required',
            'price' => 30,
            'processing_days' => 3
        ]);

        \App\Models\Service::factory()->create([
            'service_code' => 'CWA',
            'name' => 'Certificate of Weighted Average',
            'img' => 'https://cdn-icons-png.flaticon.com/128/3000/3000776.png',
            'clearance' => 'not',
            'price' => 30,
            'processing_days' => 1
        ]);

        \App\Models\Service::factory()->create([
            'service_code' => 'CEU',
            'name' => 'Certification of Earned Units',
            'img' => 'https://cdn-icons-png.flaticon.com/128/3387/3387685.png',
            'clearance' => 'not',
            'price' => 30,
            'processing_days' => 1
        ]);

        \App\Models\Service::factory()->create([
            'service_code' => 'CCE',
            'name' => 'Certification as Currently Enrolled',
            'img' => 'https://cdn-icons-png.flaticon.com/128/2036/2036412.png',
            'clearance' => 'not',
            'price' => 30,
            'processing_days' => 1
        ]);

        \App\Models\Service::factory()->create([
            'service_code' => 'CAG',
            'name' => 'Certificate as Graduate',
            'img' => 'https://cdn-icons-png.flaticon.com/128/3135/3135763.png',
            'clearance' => 'not',
            'price' => 30,
            'processing_days' => 1
        ]);

        \App\Models\Requirement::factory()->create([
            'name' => 'Picture (Passport Size)',
            'price' => 0,
            'quantity' => 0,
            'requirement_code' => "p"
        ]);

        \App\Models\Requirement::factory()->create([
            'name' => 'Picture (2x2 white background)',
            'price' => 0,
            'quantity' => 0,
            'requirement_code' => "tbt"
        ]);

        \App\Models\Requirement::factory()->create([
            'name' => 'Documentary Stamps',
            'price' => 40,
            'quantity' => 0,
            'requirement_code' => "ds"
        ]);

        \App\Models\Requirement::factory()->create([
            'name' => 'Affidavit of Loss',
            'price' => 0,
            'quantity' => 0,
            'requirement_code' => "aol"
        ]);

        \App\Models\Requirement::factory()->create([
            'name' => 'PSA (NSO) Authenticated Certificate (Photocopy)',
            'price' => 0,
            'quantity' => 0,
            'requirement_code' => "pbc"
        ]);

        \App\Models\Requirement::factory()->create([
            'name' => 'SPA (Special Power of Attorney)',
            'price' => 0,
            'quantity' => 0,
            'requirement_code' => "spa"
        ]);

        \App\Models\Requirement::factory()->create([
            'name' => 'Authorization Letter from document owner',
            'price' => 0,
            'quantity' => 0,
            'requirement_code' => "alfo"
        ]);

        \App\Models\Requirement::factory()->create([
            'name' => 'Photocopy of Valid ID of Authorized Representative',
            'price' => 0,
            'quantity' => 0,
            'requirement_code' => "viar"
        ]);

        //SERVICE REQUIREMENTS

        //tor
        \App\Models\ServiceRequirement::factory()->create([
            'service_code' => "TOR",
            'name' => 'Picture (Passport Size)',
            'requirement_code' => "p",
            'price' => 0,
            'quantity' => 1,
            'total_price' => 0,
        ]);

        \App\Models\ServiceRequirement::factory()->create([
            'service_code' => "TOR",
            'name' => 'Documentary Stamps',
            'requirement_code' => "ds",
            'price' => 40,
            'quantity' => 1,
            'total_price' => 40,
        ]);

        //diploma
        \App\Models\ServiceRequirement::factory()->create([
            'service_code' => "DIPLOMA",
            'name' => 'Picture (Passport Size)',
            'requirement_code' => "p",
            'price' => 0,
            'quantity' => 1,
            'total_price' => 0,
        ]);

        \App\Models\ServiceRequirement::factory()->create([
            'service_code' => "DIPLOMA",
            'name' => 'Documentary Stamps',
            'requirement_code' => "ds",
            'price' => 40,
            'quantity' => 1,
            'total_price' => 40,
        ]);

        //transfer credentials
        \App\Models\ServiceRequirement::factory()->create([
            'service_code' => "TC",
            'name' => 'Picture (Passport Size)',
            'requirement_code' => "p",
            'price' => 0,
            'quantity' => 1,
            'total_price' => 0,
        ]);

        \App\Models\ServiceRequirement::factory()->create([
            'service_code' => "TC",
            'name' => 'Documentary Stamps',
            'requirement_code' => "ds",
            'price' => 40,
            'quantity' => 1,
            'total_price' => 40,
        ]);

        //cog
        \App\Models\ServiceRequirement::factory()->create([
            'service_code' => "COG",
            'name' => 'Documentary Stamps',
            'requirement_code' => "ds",
            'price' => 40,
            'quantity' => 1,
            'total_price' => 40,
        ]);

        //cbfs
        \App\Models\ServiceRequirement::factory()->create([
            'service_code' => "CBFS",
            'name' => 'Documentary Stamps',
            'requirement_code' => "ds",
            'price' => 40,
            'quantity' => 1,
            'total_price' => 40,
        ]);

        //cwa
        \App\Models\ServiceRequirement::factory()->create([
            'service_code' => "CWA",
            'name' => 'Documentary Stamps',
            'requirement_code' => "ds",
            'price' => 40,
            'quantity' => 1,
            'total_price' => 40,
        ]);

        //ceu
        \App\Models\ServiceRequirement::factory()->create([
            'service_code' => "CEU",
            'name' => 'Documentary Stamps',
            'requirement_code' => "ds",
            'price' => 40,
            'quantity' => 1,
            'total_price' => 40,
        ]);

        //cce
        \App\Models\ServiceRequirement::factory()->create([
            'service_code' => "CCE",
            'name' => 'Documentary Stamps',
            'requirement_code' => "ds",
            'price' => 40,
            'quantity' => 1,
            'total_price' => 40,
        ]);

        //cag
        \App\Models\ServiceRequirement::factory()->create([
            'service_code' => "CAG",
            'name' => 'Documentary Stamps',
            'requirement_code' => "ds",
            'price' => 40,
            'quantity' => 1,
            'total_price' => 40,
        ]);


        //USERS

        \App\Models\User::factory()->create([
            'first_name' => "superadmin",
            'middle_name' => "",
            'last_name' => "",
            'email' => "superadmin@test.com",
            'password' => Hash::make("admin"),
            'role' => 1,
            'status' => "active"
        ]);

        \App\Models\User::factory()->create([
            'first_name' => "registraradmin",
            'middle_name' => "",
            'last_name' => "",
            'email' => "registraradmin@test.com",
            'password' => Hash::make("admin"),
            'role' => 2,
            'status' => "active",
            'e_signature' => "registrar.png",
            'e_path' => "images/registrar.png"
        ]);

        \App\Models\User::factory()->create([
            'first_name' => "Noime",
            'middle_name' => "Abaya",
            'last_name' => "Teves",
            'email' => "noimeteves@gmail.com",
            'password' => Hash::make("noime18"),
            'role' => 3,
            'status' => "active",
        ]);

        \App\Models\User::factory()->create([
            'first_name' => "libraryadmin",
            'middle_name' => "",
            'last_name' => "",
            'email' => "libraryadmin@test.com",
            'password' => Hash::make("admin"),
            'role' => 4,
            'status' => "active",
            'e_signature' => "library.png",
            'e_path' => "images/library.png"
        ]);

        \App\Models\User::factory()->create([
            'first_name' => "accountingservicesadmin",
            'middle_name' => "",
            'last_name' => "",
            'email' => "accountingservicesadmin@test.com",
            'password' => Hash::make("admin"),
            'role' => 5,
            'status' => "active",
            'e_signature' => "accountingservices.png",
            'e_path' => "images/accountingservices.png"
        ]);

        \App\Models\User::factory()->create([
            'first_name' => "studentservicesadmin",
            'middle_name' => "",
            'last_name' => "",
            'email' => "studentservicesadmin@test.com",
            'password' => Hash::make("admin"),
            'role' => 6,
            'status' => "active",
            'e_signature' => "studentservices.png",
            'e_path' => "images/studentservices.png"
        ]);

        \App\Models\User::factory()->create([
            'first_name' => "dormadmin",
            'middle_name' => "",
            'last_name' => "",
            'email' => "dormadmin@test.com",
            'password' => Hash::make("admin"),
            'role' => 7,
            'status' => "active",
            'e_signature' => "dorm.png",
            'e_path' => "images/dorm.png"
        ]);

        \App\Models\User::factory()->create([
            'first_name' => "deanadmin",
            'middle_name' => "",
            'last_name' => "",
            'email' => "deanadmin@test.com",
            'password' => Hash::make("admin"),
            'role' => 8,
            'status' => "active",
            'college' => 'CEA',
            'e_signature' => "CEA.png",
            'e_path' => "images/CEA.png"
        ]);

        \App\Models\User::factory()->create([
            'first_name' => "John Carl",
            'middle_name' => "Castro",
            'last_name' => "Cueva",
            'id_number' => "2020-04291",
            'educational_status' => "Undergraduate",
            'year_level' => 4,
            'email' => "johncarlcastrocueva@gmail.com",
            'contact_number' => "9605510756",
            'program' => "BSCPE",
            'password' => Hash::make("gabriellehope24"),
            'role' => 9,
            'status' => "active",
            'college' => "CEA"
        ]);

        \App\Models\User::factory()->create([
            'first_name' => "Charles Joval",
            'middle_name' => "Tañon",
            'last_name' => "Benavidez",
            'id_number' => "2020-04304",
            'educational_status' => "Undergraduate",
            'year_level' => 4,
            'email' => "benavidezcharlesjoval@gmail.com",
            'contact_number' => "9111111111",
            'program' => "BSCPE",
            'password' => Hash::make("qwerty123"),
            'role' => 9,
            'status' => "active",
            'college' => "CEA"
        ]);

        \App\Models\User::factory()->create([
            'first_name' => "Charles Emmanuel",
            'middle_name' => "Rima",
            'last_name' => "Alvar",
            'id_number' => "2020-04338",
            'educational_status' => "Undergraduate",
            'year_level' => 4,
            'email' => "charlesemmanuelr.alvar@gmail.com",
            'contact_number' => "9222222222",
            'program' => "BSCPE",
            'password' => Hash::make("utob169"),
            'role' => 9,
            'status' => "active",
            'college' => "CEA"
        ]);

        // \App\Models\User::factory()->create([
        //     'first_name' => "Noime",
        //     'middle_name' => "Abaya",
        //     'last_name' => "Teves",
        //     'id_number' => "2020-04335",
        //     'educational_status' => "Undergraduate",
        //     'year_level' => 4,
        //     'email' => "noimeteves@gmail.com",
        //     'contact_number' => "9333333333",
        //     'program' => "BSCPE",
        //     'password' => Hash::make("noime18"),
        //     'role' => 9,
        //     'status' => "active",
        //     'college' => "CEA"
        // ]);

        //STUDENTS

        \App\Models\Student::factory()->create([
            "first_name" => "John Carl",
            "middle_name" => "Castro",
            "last_name" => "Cueva",
            "id_number" => "2020-04291"
        ]);

        \App\Models\Student::factory()->create([
            "first_name" => "Charles Joval",
            "middle_name" => "Tañon",
            "last_name" => "Benavidez",
            "id_number" => "2020-04304"
        ]);

        \App\Models\Student::factory()->create([
            "first_name" => "Charles Emmanuel",
            "middle_name" => "Rima",
            "last_name" => "Alvar",
            "id_number" => "2020-04338"
        ]);

        \App\Models\Student::factory()->create([
            "first_name" => "Noime",
            "middle_name" => "Abaya",
            "last_name" => "Teves",
            "id_number" => "2020-04335"
        ]);
    }
}