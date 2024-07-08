@extends('admin.layout.master')

@section('title', 'Add Technician')
@section('content')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

<div class="container">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Technician</h1>
    </div>

    <div class="p-4">
        <form class="user" method="POST" action="{{ route('admin.technical.save-agent') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="text-center">
                <img src="https://www.svgrepo.com/show/495590/profile-circle.svg" id="profileImage"
                    class="profile-image mb-4">
                <input type="file" class="form-control col-3 mx-auto" id="imageInput" name="imageInput"
                    accept="image/*" onchange="loadImage(event)">
                @error('imageInput')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <small class="text-muted">Name</small>
                <input type="text" class="mb-2 form-control" id="name" name="name" placeholder="name"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <small class="text-muted">Email</small>
                <input type="email" class="mb-2 form-control" id="email" name="email"
                    placeholder="email@example.com" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <small class="text-muted">New Password</small>
                <input type="password" class="mb-2 form-control" id="password" name="password"
                    placeholder="Enter a new password">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <small class="text-muted">Confirm Password</small>
                <input type="password" class="mb-2 form-control" id="confirm_password" name="confirm_password"
                    placeholder="Confirm the new password">
                @error('confirm_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="name">
                <div class="form-group">
                    <small class="text-muted">Date of Birth</small>
                    <input type="date" class="mb-0 form-control" id="dob" name="date_of_birth"
                        value="{{ old('date_of_birth') }}">
                    @error('date_of_birth')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <small class="text-muted">Nationality</small>
                    <select class="mb-0 form-select form-control-sm toggle" name="nationality" id="nationality">
                        <option value="afghan" {{ old('nationality') == 'afghan' ? 'selected' : '' }}>Afghan</option>
                        <option value="albanian" {{ old('nationality') == 'albanian' ? 'selected' : '' }}>Albanian</option>
                        <option value="algerian" {{ old('nationality') == 'algerian' ? 'selected' : '' }}>Algerian</option>
                        <option value="american" {{ old('nationality') == 'american' ? 'selected' : '' }}>American</option>
                        <option value="andorran" {{ old('nationality') == 'andorran' ? 'selected' : '' }}>Andorran</option>
                        <option value="angolan" {{ old('nationality') == 'angolan' ? 'selected' : '' }}>Angolan</option>
                        <option value="antiguans" {{ old('nationality') == 'antiguans' ? 'selected' : '' }}>Antiguans</option>
                        <option value="argentinean" {{ old('nationality') == 'argentinean' ? 'selected' : '' }}>Argentinean</option>
                        <option value="armenian" {{ old('nationality') == 'armenian' ? 'selected' : '' }}>Armenian</option>
                        <option value="australian" {{ old('nationality') == 'australian' ? 'selected' : '' }}>Australian</option>
                        <option value="austrian" {{ old('nationality') == 'austrian' ? 'selected' : '' }}>Austrian</option>
                        <option value="azerbaijani" {{ old('nationality') == 'azerbaijani' ? 'selected' : '' }}>Azerbaijani</option>
                        <option value="bahamian" {{ old('nationality') == 'bahamian' ? 'selected' : '' }}>Bahamian</option>
                        <option value="bahraini" {{ old('nationality') == 'bahraini' ? 'selected' : '' }}>Bahraini</option>
                        <option value="bangladeshi" {{ old('nationality') == 'bangladeshi' ? 'selected' : '' }}>Bangladeshi</option>
                        <option value="barbadian" {{ old('nationality') == 'barbadian' ? 'selected' : '' }}>Barbadian</option>
                        <option value="barbudans" {{ old('nationality') == 'barbudans' ? 'selected' : '' }}>Barbudans</option>
                        <option value="batswana" {{ old('nationality') == 'batswana' ? 'selected' : '' }}>Batswana</option>
                        <option value="belarusian" {{ old('nationality') == 'belarusian' ? 'selected' : '' }}>Belarusian</option>
                        <option value="belgian" {{ old('nationality') == 'belgian' ? 'selected' : '' }}>Belgian</option>
                        <option value="belizean" {{ old('nationality') == 'belizean' ? 'selected' : '' }}>Belizean</option>
                        <option value="beninese" {{ old('nationality') == 'beninese' ? 'selected' : '' }}>Beninese</option>
                        <option value="bhutanese" {{ old('nationality') == 'bhutanese' ? 'selected' : '' }}>Bhutanese</option>
                        <option value="bolivian" {{ old('nationality') == 'bolivian' ? 'selected' : '' }}>Bolivian</option>
                        <option value="bosnian" {{ old('nationality') == 'bosnian' ? 'selected' : '' }}>Bosnian</option>
                        <option value="brazilian" {{ old('nationality') == 'brazilian' ? 'selected' : '' }}>Brazilian</option>
                        <option value="british" {{ old('nationality') == 'british' ? 'selected' : '' }}>British</option>
                        <option value="bruneian" {{ old('nationality') == 'bruneian' ? 'selected' : '' }}>Bruneian</option>
                        <option value="bulgarian" {{ old('nationality') == 'bulgarian' ? 'selected' : '' }}>Bulgarian</option>
                        <option value="burkinabe" {{ old('nationality') == 'burkinabe' ? 'selected' : '' }}>Burkinabe</option>
                        <option value="burmese" {{ old('nationality') == 'burmese' ? 'selected' : '' }}>Burmese</option>
                        <option value="burundian" {{ old('nationality') == 'burundian' ? 'selected' : '' }}>Burundian</option>
                        <option value="cambodian" {{ old('nationality') == 'cambodian' ? 'selected' : '' }}>Cambodian</option>
                        <option value="cameroonian" {{ old('nationality') == 'cameroonian' ? 'selected' : '' }}>Cameroonian</option>
                        <option value="canadian" {{ old('nationality') == 'canadian' ? 'selected' : '' }}>Canadian</option>
                        <option value="cape verdean" {{ old('nationality') == 'cape verdean' ? 'selected' : '' }}>Cape Verdean</option>
                        <option value="central african" {{ old('nationality') == 'central african' ? 'selected' : '' }}>Central African</option>
                        <option value="chadian" {{ old('nationality') == 'chadian' ? 'selected' : '' }}>Chadian</option>
                        <option value="chilean" {{ old('nationality') == 'chilean' ? 'selected' : '' }}>Chilean</option>
                        <option value="chinese" {{ old('nationality') == 'chinese' ? 'selected' : '' }}>Chinese</option>
                        <option value="colombian" {{ old('nationality') == 'colombian' ? 'selected' : '' }}>Colombian</option>
                        <option value="comoran" {{ old('nationality') == 'comoran' ? 'selected' : '' }}>Comoran</option>
                        <option value="congolese" {{ old('nationality') == 'congolese' ? 'selected' : '' }}>Congolese</option>
                        <option value="costa rican" {{ old('nationality') == 'costa rican' ? 'selected' : '' }}>Costa Rican</option>
                        <option value="croatian" {{ old('nationality') == 'croatian' ? 'selected' : '' }}>Croatian</option>
                        <option value="cuban" {{ old('nationality') == 'cuban' ? 'selected' : '' }}>Cuban</option>
                        <option value="cypriot" {{ old('nationality') == 'cypriot' ? 'selected' : '' }}>Cypriot</option>
                        <option value="czech" {{ old('nationality') == 'czech' ? 'selected' : '' }}>Czech</option>
                        <option value="danish" {{ old('nationality') == 'danish' ? 'selected' : '' }}>Danish</option>
                        <option value="djibouti" {{ old('nationality') == 'djibouti' ? 'selected' : '' }}>Djibouti</option>
                        <option value="dominican" {{ old('nationality') == 'dominican' ? 'selected' : '' }}>Dominican</option>
                        <option value="dutch" {{ old('nationality') == 'dutch' ? 'selected' : '' }}>Dutch</option>
                        <option value="east timorese" {{ old('nationality') == 'east timorese' ? 'selected' : '' }}>East Timorese</option>
                        <option value="ecuadorean" {{ old('nationality') == 'ecuadorean' ? 'selected' : '' }}>Ecuadorean</option>
                        <option value="egyptian" {{ old('nationality') == 'egyptian' ? 'selected' : '' }}>Egyptian</option>
                        <option value="emirian" {{ old('nationality') == 'emirian' ? 'selected' : '' }}>Emirian</option>
                        <option value="equatorial guinean" {{ old('nationality') == 'equatorial guinean' ? 'selected' : '' }}>Equatorial Guinean</option>
                        <option value="eritrean" {{ old('nationality') == 'eritrean' ? 'selected' : '' }}>Eritrean</option>
                        <option value="estonian" {{ old('nationality') == 'estonian' ? 'selected' : '' }}>Estonian</option>
                        <option value="ethiopian" {{ old('nationality') == 'ethiopian' ? 'selected' : '' }}>Ethiopian</option>
                        <option value="fijian" {{ old('nationality') == 'fijian' ? 'selected' : '' }}>Fijian</option>
                        <option value="filipino" {{ old('nationality') == 'filipino' ? 'selected' : '' }}>Filipino</option>
                        <option value="finnish" {{ old('nationality') == 'finnish' ? 'selected' : '' }}>Finnish</option>
                        <option value="french" {{ old('nationality') == 'french' ? 'selected' : '' }}>French</option>
                        <option value="gabonese" {{ old('nationality') == 'gabonese' ? 'selected' : '' }}>Gabonese</option>
                        <option value="gambian" {{ old('nationality') == 'gambian' ? 'selected' : '' }}>Gambian</option>
                        <option value="georgian" {{ old('nationality') == 'georgian' ? 'selected' : '' }}>Georgian</option>
                        <option value="german" {{ old('nationality') == 'german' ? 'selected' : '' }}>German</option>
                        <option value="ghanaian" {{ old('nationality') == 'ghanaian' ? 'selected' : '' }}>Ghanaian</option>
                        <option value="greek" {{ old('nationality') == 'greek' ? 'selected' : '' }}>Greek</option>
                        <option value="grenadian" {{ old('nationality') == 'grenadian' ? 'selected' : '' }}>Grenadian</option>
                        <option value="guatemalan" {{ old('nationality') == 'guatemalan' ? 'selected' : '' }}>Guatemalan</option>
                        <option value="guinea-bissauan" {{ old('nationality') == 'guinea-bissauan' ? 'selected' : '' }}>Guinea-Bissauan</option>
                        <option value="guinean" {{ old('nationality') == 'guinean' ? 'selected' : '' }}>Guinean</option>
                        <option value="guyanese" {{ old('nationality') == 'guyanese' ? 'selected' : '' }}>Guyanese</option>
                        <option value="haitian" {{ old('nationality') == 'haitian' ? 'selected' : '' }}>Haitian</option>
                        <option value="herzegovinian" {{ old('nationality') == 'herzegovinian' ? 'selected' : '' }}>Herzegovinian</option>
                        <option value="honduran" {{ old('nationality') == 'honduran' ? 'selected' : '' }}>Honduran</option>
                        <option value="hungarian" {{ old('nationality') == 'hungarian' ? 'selected' : '' }}>Hungarian</option>
                        <option value="icelander" {{ old('nationality') == 'icelander' ? 'selected' : '' }}>Icelander</option>
                        <option value="indian" {{ old('nationality') == 'indian' ? 'selected' : '' }}>Indian</option>
                        <option value="indonesian" {{ old('nationality') == 'indonesian' ? 'selected' : '' }}>Indonesian</option>
                        <option value="iranian" {{ old('nationality') == 'iranian' ? 'selected' : '' }}>Iranian</option>
                        <option value="iraqi" {{ old('nationality') == 'iraqi' ? 'selected' : '' }}>Iraqi</option>
                        <option value="irish" {{ old('nationality') == 'irish' ? 'selected' : '' }}>Irish</option>
                        <option value="israeli" {{ old('nationality') == 'israeli' ? 'selected' : '' }}>Israeli</option>
                        <option value="italian" {{ old('nationality') == 'italian' ? 'selected' : '' }}>Italian</option>
                        <option value="ivorian" {{ old('nationality') == 'ivorian' ? 'selected' : '' }}>Ivorian</option>
                        <option value="jamaican" {{ old('nationality') == 'jamaican' ? 'selected' : '' }}>Jamaican</option>
                        <option value="japanese" {{ old('nationality') == 'japanese' ? 'selected' : '' }}>Japanese</option>
                        <option value="jordanian" {{ old('nationality') == 'jordanian' ? 'selected' : '' }}>Jordanian</option>
                        <option value="kazakhstani" {{ old('nationality') == 'kazakhstani' ? 'selected' : '' }}>Kazakhstani</option>
                        <option value="kenyan" {{ old('nationality') == 'kenyan' ? 'selected' : '' }}>Kenyan</option>
                        <option value="kittian and nevisian" {{ old('nationality') == 'kittian and nevisian' ? 'selected' : '' }}>Kittian and Nevisian</option>
                        <option value="kuwaiti" {{ old('nationality') == 'kuwaiti' ? 'selected' : '' }}>Kuwaiti</option>
                        <option value="kyrgyz" {{ old('nationality') == 'kyrgyz' ? 'selected' : '' }}>Kyrgyz</option>
                        <option value="laotian" {{ old('nationality') == 'laotian' ? 'selected' : '' }}>Laotian</option>
                        <option value="latvian" {{ old('nationality') == 'latvian' ? 'selected' : '' }}>Latvian</option>
                        <option value="lebanese" {{ old('nationality') == 'lebanese' ? 'selected' : '' }}>Lebanese</option>
                        <option value="liberian" {{ old('nationality') == 'liberian' ? 'selected' : '' }}>Liberian</option>
                        <option value="libyan" {{ old('nationality') == 'libyan' ? 'selected' : '' }}>Libyan</option>
                        <option value="liechtensteiner" {{ old('nationality') == 'liechtensteiner' ? 'selected' : '' }}>Liechtensteiner</option>
                        <option value="lithuanian" {{ old('nationality') == 'lithuanian' ? 'selected' : '' }}>Lithuanian</option>
                        <option value="luxembourger" {{ old('nationality') == 'luxembourger' ? 'selected' : '' }}>Luxembourger</option>
                        <option value="macedonian" {{ old('nationality') == 'macedonian' ? 'selected' : '' }}>Macedonian</option>
                        <option value="malagasy" {{ old('nationality') == 'malagasy' ? 'selected' : '' }}>Malagasy</option>
                        <option value="malawian" {{ old('nationality') == 'malawian' ? 'selected' : '' }}>Malawian</option>
                        <option value="malaysian" {{ old('nationality') == 'malaysian' ? 'selected' : '' }}>Malaysian</option>
                        <option value="maldivan" {{ old('nationality') == 'maldivan' ? 'selected' : '' }}>Maldivan</option>
                        <option value="malian" {{ old('nationality') == 'malian' ? 'selected' : '' }}>Malian</option>
                        <option value="maltese" {{ old('nationality') == 'maltese' ? 'selected' : '' }}>Maltese</option>
                        <option value="marshallese" {{ old('nationality') == 'marshallese' ? 'selected' : '' }}>Marshallese</option>
                        <option value="mauritanian" {{ old('nationality') == 'mauritanian' ? 'selected' : '' }}>Mauritanian</option>
                        <option value="mauritian" {{ old('nationality') == 'mauritian' ? 'selected' : '' }}>Mauritian</option>
                        <option value="mexican" {{ old('nationality') == 'mexican' ? 'selected' : '' }}>Mexican</option>
                        <option value="micronesian" {{ old('nationality') == 'micronesian' ? 'selected' : '' }}>Micronesian</option>
                        <option value="moldovan" {{ old('nationality') == 'moldovan' ? 'selected' : '' }}>Moldovan</option>
                        <option value="monacan" {{ old('nationality') == 'monacan' ? 'selected' : '' }}>Monacan</option>
                        <option value="mongolian" {{ old('nationality') == 'mongolian' ? 'selected' : '' }}>Mongolian</option>
                        <option value="moroccan" {{ old('nationality') == 'moroccan' ? 'selected' : '' }}>Moroccan</option>
                        <option value="mosotho" {{ old('nationality') == 'mosotho' ? 'selected' : '' }}>Mosotho</option>
                        <option value="motswana" {{ old('nationality') == 'motswana' ? 'selected' : '' }}>Motswana</option>
                        <option value="mozambican" {{ old('nationality') == 'mozambican' ? 'selected' : '' }}>Mozambican</option>
                        <option value="namibian" {{ old('nationality') == 'namibian' ? 'selected' : '' }}>Namibian</option>
                        <option value="nauruan" {{ old('nationality') == 'nauruan' ? 'selected' : '' }}>Nauruan</option>
                        <option value="nepalese" {{ old('nationality') == 'nepalese' ? 'selected' : '' }}>Nepalese</option>
                        <option value="new zealander" {{ old('nationality') == 'new zealander' ? 'selected' : '' }}>New Zealander</option>
                        <option value="ni-vanuatu" {{ old('nationality') == 'ni-vanuatu' ? 'selected' : '' }}>Ni-Vanuatu</option>
                        <option value="nicaraguan" {{ old('nationality') == 'nicaraguan' ? 'selected' : '' }}>Nicaraguan</option>
                        <option value="nigerian" {{ old('nationality') == 'nigerian' ? 'selected' : '' }}>Nigerian</option>
                        <option value="nigerien" {{ old('nationality') == 'nigerien' ? 'selected' : '' }}>Nigerien</option>
                        <option value="north korean" {{ old('nationality') == 'north korean' ? 'selected' : '' }}>North Korean</option>
                        <option value="northern irish" {{ old('nationality') == 'northern irish' ? 'selected' : '' }}>Northern Irish</option>
                        <option value="norwegian" {{ old('nationality') == 'norwegian' ? 'selected' : '' }}>Norwegian</option>
                        <option value="omani" {{ old('nationality') == 'omani' ? 'selected' : '' }}>Omani</option>
                        <option value="pakistani" {{ old('nationality') == 'pakistani' ? 'selected' : '' }}>Pakistani</option>
                        <option value="palauan" {{ old('nationality') == 'palauan' ? 'selected' : '' }}>Palauan</option>
                        <option value="palestinian" {{ old('nationality') == 'palestinian' ? 'selected' : '' }}>Palestinian</option>
                        <option value="panamanian" {{ old('nationality') == 'panamanian' ? 'selected' : '' }}>Panamanian</option>
                        <option value="papua new guinean" {{ old('nationality') == 'papua new guinean' ? 'selected' : '' }}>Papua New Guinean</option>
                        <option value="paraguayan" {{ old('nationality') == 'paraguayan' ? 'selected' : '' }}>Paraguayan</option>
                        <option value="peruvian" {{ old('nationality') == 'peruvian' ? 'selected' : '' }}>Peruvian</option>
                        <option value="polish" {{ old('nationality') == 'polish' ? 'selected' : '' }}>Polish</option>
                        <option value="portuguese" {{ old('nationality') == 'portuguese' ? 'selected' : '' }}>Portuguese</option>
                        <option value="qatari" {{ old('nationality') == 'qatari' ? 'selected' : '' }}>Qatari</option>
                        <option value="romanian" {{ old('nationality') == 'romanian' ? 'selected' : '' }}>Romanian</option>
                        <option value="russian" {{ old('nationality') == 'russian' ? 'selected' : '' }}>Russian</option>
                        <option value="rwandan" {{ old('nationality') == 'rwandan' ? 'selected' : '' }}>Rwandan</option>
                        <option value="saint lucian" {{ old('nationality') == 'saint lucian' ? 'selected' : '' }}>Saint Lucian</option>
                        <option value="salvadoran" {{ old('nationality') == 'salvadoran' ? 'selected' : '' }}>Salvadoran</option>
                        <option value="samoan" {{ old('nationality') == 'samoan' ? 'selected' : '' }}>Samoan</option>
                        <option value="san marinese" {{ old('nationality') == 'san marinese' ? 'selected' : '' }}>San Marinese</option>
                        <option value="sao tomean" {{ old('nationality') == 'sao tomean' ? 'selected' : '' }}>Sao Tomean</option>
                        <option value="saudi" {{ old('nationality') == 'saudi' ? 'selected' : '' }}>Saudi</option>
                        <option value="scottish" {{ old('nationality') == 'scottish' ? 'selected' : '' }}>Scottish</option>
                        <option value="senegalese" {{ old('nationality') == 'senegalese' ? 'selected' : '' }}>Senegalese</option>
                        <option value="serbian" {{ old('nationality') == 'serbian' ? 'selected' : '' }}>Serbian</option>
                        <option value="seychellois" {{ old('nationality') == 'seychellois' ? 'selected' : '' }}>Seychellois</option>
                        <option value="sierra leonean" {{ old('nationality') == 'sierra leonean' ? 'selected' : '' }}>Sierra Leonean</option>
                        <option value="singaporean" {{ old('nationality') == 'singaporean' ? 'selected' : '' }}>Singaporean</option>
                        <option value="slovakian" {{ old('nationality') == 'slovakian' ? 'selected' : '' }}>Slovakian</option>
                        <option value="slovenian" {{ old('nationality') == 'slovenian' ? 'selected' : '' }}>Slovenian</option>
                        <option value="solomon islander" {{ old('nationality') == 'solomon islander' ? 'selected' : '' }}>Solomon Islander</option>
                        <option value="somali" {{ old('nationality') == 'somali' ? 'selected' : '' }}>Somali</option>
                        <option value="south african" {{ old('nationality') == 'south african' ? 'selected' : '' }}>South African</option>
                        <option value="south korean" {{ old('nationality') == 'south korean' ? 'selected' : '' }}>South Korean</option>
                        <option value="spanish" {{ old('nationality') == 'spanish' ? 'selected' : '' }}>Spanish</option>
                        <option value="sri lankan" {{ old('nationality') == 'sri lankan' ? 'selected' : '' }}>Sri Lankan</option>
                        <option value="sudanese" {{ old('nationality') == 'sudanese' ? 'selected' : '' }}>Sudanese</option>
                        <option value="surinamer" {{ old('nationality') == 'surinamer' ? 'selected' : '' }}>Surinamer</option>
                        <option value="swazi" {{ old('nationality') == 'swazi' ? 'selected' : '' }}>Swazi</option>
                        <option value="swedish" {{ old('nationality') == 'swedish' ? 'selected' : '' }}>Swedish</option>
                        <option value="swiss" {{ old('nationality') == 'swiss' ? 'selected' : '' }}>Swiss</option>
                        <option value="syrian" {{ old('nationality') == 'syrian' ? 'selected' : '' }}>Syrian</option>
                        <option value="taiwanese" {{ old('nationality') == 'taiwanese' ? 'selected' : '' }}>Taiwanese</option>
                        <option value="tajik" {{ old('nationality') == 'tajik' ? 'selected' : '' }}>Tajik</option>
                        <option value="tanzanian" {{ old('nationality') == 'tanzanian' ? 'selected' : '' }}>Tanzanian</option>
                        <option value="thai" {{ old('nationality') == 'thai' ? 'selected' : '' }}>Thai</option>
                        <option value="togolese" {{ old('nationality') == 'togolese' ? 'selected' : '' }}>Togolese</option>
                        <option value="tongan" {{ old('nationality') == 'tongan' ? 'selected' : '' }}>Tongan</option>
                        <option value="trinidadian or tobagonian" {{ old('nationality') == 'trinidadian or tobagonian' ? 'selected' : '' }}>Trinidadian or Tobagonian</option>
                        <option value="tunisian" {{ old('nationality') == 'tunisian' ? 'selected' : '' }}>Tunisian</option>
                        <option value="turkish" {{ old('nationality') == 'turkish' ? 'selected' : '' }}>Turkish</option>
                        <option value="tuvaluan" {{ old('nationality') == 'tuvaluan' ? 'selected' : '' }}>Tuvaluan</option>
                        <option value="ugandan" {{ old('nationality') == 'ugandan' ? 'selected' : '' }}>Ugandan</option>
                        <option value="ukrainian" {{ old('nationality') == 'ukrainian' ? 'selected' : '' }}>Ukrainian</option>
                        <option value="uruguayan" {{ old('nationality') == 'uruguayan' ? 'selected' : '' }}>Uruguayan</option>
                        <option value="uzbekistani" {{ old('nationality') == 'uzbekistani' ? 'selected' : '' }}>Uzbekistani</option>
                        <option value="venezuelan" {{ old('nationality') == 'venezuelan' ? 'selected' : '' }}>Venezuelan</option>
                        <option value="vietnamese" {{ old('nationality') == 'vietnamese' ? 'selected' : '' }}>Vietnamese</option>
                        <option value="welsh" {{ old('nationality') == 'welsh' ? 'selected' : '' }}>Welsh</option>
                        <option value="yemenite" {{ old('nationality') == 'yemenite' ? 'selected' : '' }}>Yemenite</option>
                        <option value="zambian" {{ old('nationality') == 'zambian' ? 'selected' : '' }}>Zambian</option>
                        <option value="zimbabwean" {{ old('nationality') == 'zimbabwean' ? 'selected' : '' }}>Zimbabwean</option>
                    </select>
                    @error('nationality')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <small class="text-muted">Phone Number</small>
                    <input type="text" class="form-control form-control-sm" name="phone" id="phone"
                        value="{{ old('phone') }}">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <small class="text-muted">Status</small>
                    <select class="mb-0 form-select form-control-sm toggle" name="status" id="status" style="width:90px">
                        <option value="online" {{ old('status') == 'online' ? 'selected' : '' }}>online</option>
                        <option value="offline" {{ old('status') == 'offline' ? 'selected' : '' }}>offline</option>
                        <option value="idle" {{ old('status') == 'idle' ? 'selected' : '' }}>idle</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>                
            </div>
            <button type="submit" class="btn save-btn" style="background-color: black; color: white">Save</button>
        </form>
        <br>
        <a href="{{ route('admin.technical') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>

    </div>
</div>

@section('script')
    <script src="{{ asset('js/profile.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('js/password.js')}}"></script>
@endsection




@stop
