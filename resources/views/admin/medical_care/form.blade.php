@extends('layouts.admin.app')

@section('content')

<div class="mt-3 mb-3">
    <span class="h5 text-800">Atendimento Médico</span>
</div>

<!-- form -- start -->
<form class="mt-3 needs-validation" id="form" name="form" method="POST" enctype="multipart/form-data" action="{{ empty($medical_care->IdMedicalCare) ? route('medical_care.form.create', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) : route('medical_care.form.update', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices), 'IdMedicalCare' => base64_encode($medical_care->IdMedicalCare)])}}" novalidate="">

    @csrf <!--token--> 

    <div class="col-12 mb-2">
        <div class="card border h-100 border-primary">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-sm-auto mb-2 mb-sm-0">
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button class="btn btn-primary btn-sm" type="button" data-redirect="{{ route('medical_care') }}"><span class="fas fa-arrow-left"></span></button>
                            <button class="btn btn-primary btn-sm" type="submit"><span class="fas fa-save"></span></button>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="row gx-2 align-items-center">
                            <nav style="--falcon-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23748194'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('medical_care')}}">Atendimentos Médicos</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">@if(empty($medical_care))Inserir @else Editar @endif</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">

        <!-- info users current -->
        <div class="col-sm-12 col-md-12">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row flex-between-end">
                        <div class="col-12 align-self-center">
                            <h5>
                                <h6 class="alert-heading fw-semi-bold">
                                    <span class="
                                    @if((!empty($emergency_services->last_screenings())) AND $emergency_services->last_screenings()->classification == 4)
                                        emergency
                                    @elseif((!empty($emergency_services->last_screenings())) AND $emergency_services->last_screenings()->classification == 3)
                                        very_urgent
                                    @elseif((!empty($emergency_services->last_screenings())) AND $emergency_services->last_screenings()->classification == 2)
                                        urgent
                                    @elseif((!empty($emergency_services->last_screenings())) AND $emergency_services->last_screenings()->classification == 1)
                                        little_urgent
                                    @elseif((!empty($emergency_services)) AND $emergency_services->last_screenings()->classification == 0)
                                        not_urgent
                                    @else
                                        bg-500
                                    @endif me-1 icon-item" style="float: left;"></span>

                                   <span class="mt-1"> {{ $emergency_services->users_name }}
                                    @if(strlen($emergency_services->users_cpf_cnpj) == 11)
                                        •  {{ Mask::default($emergency_services->users_cpf_cnpj, '###.###.###-##') }}
                                    @elseif(strlen($emergency_services->users_cpf_cnpj) == 14)
                                        •  {{ Mask::default($emergency_services->users_cpf_cnpj, '##.###.###/####-##') }}
                                    @endif
                        
                                    @if($emergency_services->users_date_birth)
                                        • {{ Mask::birth($emergency_services->users_date_birth) }} ANOS
                                    @endif</span> 
                                </h6>
                        
                                <h6 class="alert-heading fw-semi-bold">
                                    <span class="h6 alert-heading fw-semi-bold"><strong>Atendimento:</strong> {{$emergency_services->IdEmergencyServices}}</span>
                                    • <span class="h6 alert-heading fw-semi-bold"><strong>Entrada:</strong> {{ $emergency_services->created_at->format('d-m-Y H:i') }}</span> 
                                </h6>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-3">
            <div class="kanban-items-container border bg-white rounded-2 py-3 mb-3" style="max-height: none;">

                <div class="card mb-3 kanban-item shadow-sm active" data-class="data-front-desk">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="far fa-file-alt fs-0"></span>
                            <span class="nav-link-text ps-1">Informações</span>
                        </p>
                    </div>
                </div>

                <div class="card mb-3 kanban-item shadow-sm" data-class="data-attendance">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fas fa-user-md fs-0"></span>
                            <span class="nav-link-text ps-1">Atendimento</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="data-upload">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fas fa-upload fs-0"></span>
                            <span class="nav-link-text ps-1">Upload de Arquivos</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="allergies-diseases">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fas fa-first-aid fs-0"></span>
                            <span class="nav-link-text ps-1">Alergias / Doenças / Antecedentes</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="data-historic">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="fas fa-history fs-0"></span>
                            <span class="nav-link-text ps-1">Histórico</span>
                        </p>
                    </div>
                </div>
                <div class="card mb-3 kanban-item shadow-sm" data-class="registration-data">
                    <div class="card-body">
                        <p class="fs--1 fw-medium font-sans-serif mb-0 d-flex align-items-center">
                            <span class="far fa-address-card fs-0"></span>
                            <span class="nav-link-text ps-1">Dados Cadastrais</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-9">

            <!-- atendimento -->
            <div class="data-attendance block-item-class">

                <!-- anamnesis - start -->
                <div class="col-lg-12 col-xl-12 col-xxl-12 h-100">
                    <div class="col-lg-6 col-xl-12 col-xxl-6 h-100">
                        <div class="d-flex mb-4">
                            <span class="fa-stack me-2 ms-n1"><i class="fas fa-circle fa-stack-2x text-300"></i><i class="fa-inverse fa-stack-1x text-primary fas fa-check-double"></i></span>
                            <div class="col">
                                <h5 class="mb-0 text-primary position-relative">
                                    <span class="bg-200 dark__bg-1100 pe-3">With Validation</span><span class="border position-absolute top-50 translate-middle-y w-100 start-0 z-n1"></span>
                                </h5>
                                <p class="mb-0">You can easily show your stats content by using these cards.</p>
                            </div>
                        </div>
                        <div class="card theme-wizard h-100 mb-5">
                            <div class="card-header bg-light pt-3 pb-2">
                                <ul class="nav justify-content-between nav-wizard">
                                    <li class="nav-item">
                                        <a class="nav-link active fw-semi-bold" href="#bootstrap-wizard-validation-tab1" data-bs-toggle="tab" data-wizard-step="data-wizard-step">
                                            <span class="nav-item-circle-parent">
                                                <span class="nav-item-circle"><span class="fas fa-lock"></span></span>
                                            </span>
                                            <span class="d-none d-md-block mt-1 fs--1">Account</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-semi-bold" href="#bootstrap-wizard-validation-tab2" data-bs-toggle="tab" data-wizard-step="data-wizard-step">
                                            <span class="nav-item-circle-parent">
                                                <span class="nav-item-circle"><span class="fas fa-user"></span></span>
                                            </span>
                                            <span class="d-none d-md-block mt-1 fs--1">Personal</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-semi-bold" href="#bootstrap-wizard-validation-tab3" data-bs-toggle="tab" data-wizard-step="data-wizard-step">
                                            <span class="nav-item-circle-parent">
                                                <span class="nav-item-circle"><span class="fas fa-dollar-sign"></span></span>
                                            </span>
                                            <span class="d-none d-md-block mt-1 fs--1">Billing</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-semi-bold" href="#bootstrap-wizard-validation-tab4" data-bs-toggle="tab" data-wizard-step="data-wizard-step">
                                            <span class="nav-item-circle-parent">
                                                <span class="nav-item-circle"><span class="fas fa-thumbs-up"></span></span>
                                            </span>
                                            <span class="d-none d-md-block mt-1 fs--1">Done</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body py-4" id="wizard-controller">
                                <div class="tab-content">
                                    <div class="tab-pane active px-sm-3 px-md-5" role="tabpanel" aria-labelledby="bootstrap-wizard-validation-tab1" id="bootstrap-wizard-validation-tab1">
                                        <form class="needs-validation" novalidate="novalidate">
                                            <div class="mb-3">
                                                <label class="form-label" for="bootstrap-wizard-validation-wizard-name">Name</label>
                                                <input class="form-control" type="text" name="name" placeholder="John Smith" id="bootstrap-wizard-validation-wizard-name" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="bootstrap-wizard-validation-wizard-email">Email*</label>
                                                <input
                                                    class="form-control"
                                                    type="email"
                                                    name="email"
                                                    placeholder="Email address"
                                                    pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$"
                                                    required="required"
                                                    id="bootstrap-wizard-validation-wizard-email"
                                                    data-wizard-validate-email="true"
                                                />
                                                <div class="invalid-feedback">You must add email</div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="bootstrap-wizard-validation-wizard-password">Password*</label>
                                                        <input
                                                            class="form-control"
                                                            type="password"
                                                            name="password"
                                                            placeholder="Password"
                                                            required="required"
                                                            id="bootstrap-wizard-validation-wizard-password"
                                                            data-wizard-validate-password="true"
                                                        />
                                                        <div class="invalid-feedback">Please enter password</div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="bootstrap-wizard-validation-wizard-confirm-password">Confirm Password*</label>
                                                        <input
                                                            class="form-control"
                                                            type="password"
                                                            name="confirmPassword"
                                                            placeholder="Confirm Password"
                                                            required="required"
                                                            id="bootstrap-wizard-validation-wizard-confirm-password"
                                                            data-wizard-validate-confirm-password="true"
                                                        />
                                                        <div class="invalid-feedback">Passwords need to match</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="terms" required="required" checked="checked" id="bootstrap-wizard-validation-wizard-checkbox" />
                                                <label class="form-check-label" for="bootstrap-wizard-validation-wizard-checkbox">I accept the <a href="#!">terms </a>and <a href="#!">privacy policy</a></label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane px-sm-3 px-md-5" role="tabpanel" aria-labelledby="bootstrap-wizard-validation-tab2" id="bootstrap-wizard-validation-tab2">
                                        <form>
                                            <div class="mb-3">
                                                <div class="row" data-dropzone="data-dropzone" data-options='{"maxFiles":1,"data":[{"name":"avatar.png","size":"54kb","url":"../../assets/img/team"}]}'>
                                                    <div class="fallback">
                                                        <input type="file" name="file" />
                                                    </div>
                                                    <div class="col-md-auto">
                                                        <div class="dz-preview dz-preview-single">
                                                            <div class="dz-preview-cover d-flex align-items-center justify-content-center mb-3 mb-md-0">
                                                                <div class="avatar avatar-4xl"><img class="rounded-circle" src="../../assets/img/team/avatar.png" alt="..." data-dz-thumbnail="data-dz-thumbnail" /></div>
                                                                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md">
                                                        <div class="dz-message dropzone-area px-2 py-3" data-dz-message="data-dz-message">
                                                            <div class="text-center">
                                                                <img class="me-2" src="../../assets/img/icons/cloud-upload.svg" width="25" alt="" />Upload your profile picture
                                                                <p class="mb-0 fs--1 text-400">
                                                                    Upload a 300x300 jpg image with <br />
                                                                    a maximum size of 400KB
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="bootstrap-wizard-validation-gender">Gender</label>
                                                <select class="form-select" name="gender" id="bootstrap-wizard-validation-gender">
                                                    <option value="">Select your gender ...</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="bootstrap-wizard-validation-wizard-phone">Phone</label>
                                                <input class="form-control" type="text" name="phone" placeholder="Phone" id="bootstrap-wizard-validation-wizard-phone" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="bootstrap-wizard-validation-wizard-datepicker">Date of Birth</label>
                                                <input class="form-control datetimepicker" type="text" placeholder="d/m/y" data-options='{"dateFormat":"d/m/y","disableMobile":true}' id="bootstrap-wizard-validation-wizard-datepicker" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="bootstrap-wizard-validation-wizard-address">Address</label>
                                                <textarea class="form-control" rows="4" id="bootstrap-wizard-validation-wizard-address"></textarea>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane px-sm-3 px-md-5" role="tabpanel" aria-labelledby="bootstrap-wizard-validation-tab3" id="bootstrap-wizard-validation-tab3">
                                        <form class="form-validation">
                                            <div class="row g-2">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="bootstrap-wizard-validation-card-number">Card Number</label>
                                                        <input class="form-control" placeholder="XXXX XXXX XXXX XXXX" type="text" id="bootstrap-wizard-validation-card-number" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="bootstrap-wizard-validation-card-name">Name on Card</label>
                                                        <input class="form-control" placeholder="John Doe" name="cardName" type="text" id="bootstrap-wizard-validation-card-name" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="bootstrap-wizard-validation-card-holder-country">Country</label>
                                                        <select class="form-select" name="customSelectCountry" id="bootstrap-wizard-validation-card-holder-country">
                                                            <option value="">Select your country ...</option>
                                                            <option value="Afghanistan">Afghanistan</option>
                                                            <option value="Albania">Albania</option>
                                                            <option value="Algeria">Algeria</option>
                                                            <option value="American Samoa">American Samoa</option>
                                                            <option value="Andorra">Andorra</option>
                                                            <option value="Angola">Angola</option>
                                                            <option value="Anguilla">Anguilla</option>
                                                            <option value="Antarctica">Antarctica</option>
                                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                            <option value="Argentina">Argentina</option>
                                                            <option value="Armenia">Armenia</option>
                                                            <option value="Aruba">Aruba</option>
                                                            <option value="Australia">Australia</option>
                                                            <option value="Austria">Austria</option>
                                                            <option value="Azerbaijan">Azerbaijan</option>
                                                            <option value="Bahamas">Bahamas</option>
                                                            <option value="Bahrain">Bahrain</option>
                                                            <option value="Bangladesh">Bangladesh</option>
                                                            <option value="Barbados">Barbados</option>
                                                            <option value="Belarus">Belarus</option>
                                                            <option value="Belgium">Belgium</option>
                                                            <option value="Belize">Belize</option>
                                                            <option value="Benin">Benin</option>
                                                            <option value="Bermuda">Bermuda</option>
                                                            <option value="Bhutan">Bhutan</option>
                                                            <option value="Bolivia">Bolivia</option>
                                                            <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                                                            <option value="Botswana">Botswana</option>
                                                            <option value="Bouvet Island">Bouvet Island</option>
                                                            <option value="Brazil">Brazil</option>
                                                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                            <option value="Bulgaria">Bulgaria</option>
                                                            <option value="Burkina Faso">Burkina Faso</option>
                                                            <option value="Burundi">Burundi</option>
                                                            <option value="Cambodia">Cambodia</option>
                                                            <option value="Cameroon">Cameroon</option>
                                                            <option value="Canada">Canada</option>
                                                            <option value="Cape Verde">Cape Verde</option>
                                                            <option value="Cayman Islands">Cayman Islands</option>
                                                            <option value="Central African Republic">Central African Republic</option>
                                                            <option value="Chad">Chad</option>
                                                            <option value="Chile">Chile</option>
                                                            <option value="China">China</option>
                                                            <option value="Christmas Island">Christmas Island</option>
                                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                            <option value="Colombia">Colombia</option>
                                                            <option value="Comoros">Comoros</option>
                                                            <option value="Congo">Congo</option>
                                                            <option value="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
                                                            <option value="Cook Islands">Cook Islands</option>
                                                            <option value="Costa Rica">Costa Rica</option>
                                                            <option value="Cote d'Ivoire">Cote d'Ivoire</option>
                                                            <option value="Croatia (Hrvatska)">Croatia (Hrvatska)</option>
                                                            <option value="Cuba">Cuba</option>
                                                            <option value="Cyprus">Cyprus</option>
                                                            <option value="Czech Republic">Czech Republic</option>
                                                            <option value="Denmark">Denmark</option>
                                                            <option value="Djibouti">Djibouti</option>
                                                            <option value="Dominica">Dominica</option>
                                                            <option value="Dominican Republic">Dominican Republic</option>
                                                            <option value="East Timor">East Timor</option>
                                                            <option value="Ecuador">Ecuador</option>
                                                            <option value="Egypt">Egypt</option>
                                                            <option value="El Salvador">El Salvador</option>
                                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                            <option value="Eritrea">Eritrea</option>
                                                            <option value="Estonia">Estonia</option>
                                                            <option value="Ethiopia">Ethiopia</option>
                                                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                                            <option value="Faroe Islands">Faroe Islands</option>
                                                            <option value="Fiji">Fiji</option>
                                                            <option value="Finland">Finland</option>
                                                            <option value="France">France</option>
                                                            <option value="France Metropolitan">France Metropolitan</option>
                                                            <option value="French Guiana">French Guiana</option>
                                                            <option value="French Polynesia">French Polynesia</option>
                                                            <option value="French Southern Territories">French Southern Territories</option>
                                                            <option value="Gabon">Gabon</option>
                                                            <option value="Gambia">Gambia</option>
                                                            <option value="Georgia">Georgia</option>
                                                            <option value="Germany">Germany</option>
                                                            <option value="Ghana">Ghana</option>
                                                            <option value="Gibraltar">Gibraltar</option>
                                                            <option value="Greece">Greece</option>
                                                            <option value="Greenland">Greenland</option>
                                                            <option value="Grenada">Grenada</option>
                                                            <option value="Guadeloupe">Guadeloupe</option>
                                                            <option value="Guam">Guam</option>
                                                            <option value="Guatemala">Guatemala</option>
                                                            <option value="Guinea">Guinea</option>
                                                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                            <option value="Guyana">Guyana</option>
                                                            <option value="Haiti">Haiti</option>
                                                            <option value="Heard and Mc Donald Islands">Heard and Mc Donald Islands</option>
                                                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                                            <option value="Honduras">Honduras</option>
                                                            <option value="Hong Kong">Hong Kong</option>
                                                            <option value="Hungary">Hungary</option>
                                                            <option value="Iceland">Iceland</option>
                                                            <option value="India">India</option>
                                                            <option value="Indonesia">Indonesia</option>
                                                            <option value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option>
                                                            <option value="Iraq">Iraq</option>
                                                            <option value="Ireland">Ireland</option>
                                                            <option value="Israel">Israel</option>
                                                            <option value="Italy">Italy</option>
                                                            <option value="Jamaica">Jamaica</option>
                                                            <option value="Japan">Japan</option>
                                                            <option value="Jordan">Jordan</option>
                                                            <option value="Kazakhstan">Kazakhstan</option>
                                                            <option value="Kenya">Kenya</option>
                                                            <option value="Kiribati">Kiribati</option>
                                                            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                                            <option value="Korea, Republic of">Korea, Republic of</option>
                                                            <option value="Kuwait">Kuwait</option>
                                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                            <option value="Lao, People's Democratic Republic">Lao, People's Democratic Republic</option>
                                                            <option value="Latvia">Latvia</option>
                                                            <option value="Lebanon">Lebanon</option>
                                                            <option value="Lesotho">Lesotho</option>
                                                            <option value="Liberia">Liberia</option>
                                                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                                            <option value="Liechtenstein">Liechtenstein</option>
                                                            <option value="Lithuania">Lithuania</option>
                                                            <option value="Luxembourg">Luxembourg</option>
                                                            <option value="Macau">Macau</option>
                                                            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                                            <option value="Madagascar">Madagascar</option>
                                                            <option value="Malawi">Malawi</option>
                                                            <option value="Malaysia">Malaysia</option>
                                                            <option value="Maldives">Maldives</option>
                                                            <option value="Mali">Mali</option>
                                                            <option value="Malta">Malta</option>
                                                            <option value="Marshall Islands">Marshall Islands</option>
                                                            <option value="Martinique">Martinique</option>
                                                            <option value="Mauritania">Mauritania</option>
                                                            <option value="Mauritius">Mauritius</option>
                                                            <option value="Mayotte">Mayotte</option>
                                                            <option value="Mexico">Mexico</option>
                                                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                                                            <option value="Monaco">Monaco</option>
                                                            <option value="Mongolia">Mongolia</option>
                                                            <option value="Montserrat">Montserrat</option>
                                                            <option value="Morocco">Morocco</option>
                                                            <option value="Mozambique">Mozambique</option>
                                                            <option value="Myanmar">Myanmar</option>
                                                            <option value="Namibia">Namibia</option>
                                                            <option value="Nauru">Nauru</option>
                                                            <option value="Nepal">Nepal</option>
                                                            <option value="Netherlands">Netherlands</option>
                                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                            <option value="New Caledonia">New Caledonia</option>
                                                            <option value="New Zealand">New Zealand</option>
                                                            <option value="Nicaragua">Nicaragua</option>
                                                            <option value="Niger">Niger</option>
                                                            <option value="Nigeria">Nigeria</option>
                                                            <option value="Niue">Niue</option>
                                                            <option value="Norfolk Island">Norfolk Island</option>
                                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                            <option value="Norway">Norway</option>
                                                            <option value="Oman">Oman</option>
                                                            <option value="Pakistan">Pakistan</option>
                                                            <option value="Palau">Palau</option>
                                                            <option value="Panama">Panama</option>
                                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                                            <option value="Paraguay">Paraguay</option>
                                                            <option value="Peru">Peru</option>
                                                            <option value="Philippines">Philippines</option>
                                                            <option value="Pitcairn">Pitcairn</option>
                                                            <option value="Poland">Poland</option>
                                                            <option value="Portugal">Portugal</option>
                                                            <option value="Puerto Rico">Puerto Rico</option>
                                                            <option value="Qatar">Qatar</option>
                                                            <option value="Reunion">Reunion</option>
                                                            <option value="Romania">Romania</option>
                                                            <option value="Russian Federation">Russian Federation</option>
                                                            <option value="Rwanda">Rwanda</option>
                                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                            <option value="Saint Lucia">Saint Lucia</option>
                                                            <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                            <option value="Samoa">Samoa</option>
                                                            <option value="San Marino">San Marino</option>
                                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                                            <option value="Senegal">Senegal</option>
                                                            <option value="Seychelles">Seychelles</option>
                                                            <option value="Sierra Leone">Sierra Leone</option>
                                                            <option value="Singapore">Singapore</option>
                                                            <option value="Slovakia (Slovak Republic)">Slovakia (Slovak Republic)</option>
                                                            <option value="Slovenia">Slovenia</option>
                                                            <option value="Solomon Islands">Solomon Islands</option>
                                                            <option value="Somalia">Somalia</option>
                                                            <option value="South Africa">South Africa</option>
                                                            <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                                            <option value="Spain">Spain</option>
                                                            <option value="Sri Lanka">Sri Lanka</option>
                                                            <option value="St. Helena">St. Helena</option>
                                                            <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option>
                                                            <option value="Sudan">Sudan</option>
                                                            <option value="Suriname">Suriname</option>
                                                            <option value="Svalbard and Jan Mayen Islands">Svalbard and Jan Mayen Islands</option>
                                                            <option value="Swaziland">Swaziland</option>
                                                            <option value="Sweden">Sweden</option>
                                                            <option value="Switzerland">Switzerland</option>
                                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                                            <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                                            <option value="Tajikistan">Tajikistan</option>
                                                            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                                            <option value="Thailand">Thailand</option>
                                                            <option value="Togo">Togo</option>
                                                            <option value="Tokelau">Tokelau</option>
                                                            <option value="Tonga">Tonga</option>
                                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                            <option value="Tunisia">Tunisia</option>
                                                            <option value="Turkey">Turkey</option>
                                                            <option value="Turkmenistan">Turkmenistan</option>
                                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                            <option value="Tuvalu">Tuvalu</option>
                                                            <option value="Uganda">Uganda</option>
                                                            <option value="Ukraine">Ukraine</option>
                                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                                            <option value="United Kingdom">United Kingdom</option>
                                                            <option value="United States">United States</option>
                                                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                            <option value="Uruguay">Uruguay</option>
                                                            <option value="Uzbekistan">Uzbekistan</option>
                                                            <option value="Vanuatu">Vanuatu</option>
                                                            <option value="Venezuela">Venezuela</option>
                                                            <option value="Vietnam">Vietnam</option>
                                                            <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                                            <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>
                                                            <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
                                                            <option value="Western Sahara">Western Sahara</option>
                                                            <option value="Yemen">Yemen</option>
                                                            <option value="Yugoslavia">Yugoslavia</option>
                                                            <option value="Zambia">Zambia</option>
                                                            <option value="Zimbabwe">Zimbabwe</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="bootstrap-wizard-validation-card-holder-zip-code">Zip Code</label>
                                                        <input class="form-control" placeholder="1234" name="zipCode" type="text" id="bootstrap-wizard-validation-card-holder-zip-code" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group mb-0">
                                                        <label class="form-label" for="bootstrap-wizard-validation-card-exp-date">Exp Date</label>
                                                        <input class="form-control" placeholder="15/2024" name="expDate" type="text" id="bootstrap-wizard-validation-card-exp-date" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group mb-0">
                                                        <label class="form-label" for="bootstrap-wizard-validation-card-cvv">CVV</label>
                                                        <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Card verification value"><span class="fa fa-question-circle"></span></span>
                                                        <input class="form-control" placeholder="123" name="cvv" maxlength="3" pattern="[0-9]{3}" type="text" id="bootstrap-wizard-validation-card-cvv" />
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane text-center px-sm-3 px-md-5" role="tabpanel" aria-labelledby="bootstrap-wizard-validation-tab4" id="bootstrap-wizard-validation-tab4">
                                        <div class="wizard-lottie-wrapper">
                                            <div class="lottie wizard-lottie mx-auto my-3" data-options='{"path":"../../assets/img/animated-icons/celebration.json"}'></div>
                                        </div>
                                        <h4 class="mb-1">Your account is all set!</h4>
                                        <p>Now you can access to your account</p>
                                        <a class="btn btn-primary px-5 my-3" href="../../modules/forms/wizard.html">Start Over</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <div class="px-sm-3 px-md-5">
                                    <ul class="pager wizard list-inline mb-0">
                                        <li class="previous">
                                            <button class="btn btn-link ps-0" type="button"><span class="fas fa-chevron-left me-2" data-fa-transform="shrink-3"></span>Prev</button>
                                        </li>
                                        <li class="next">
                                            <button class="btn btn-primary px-5 px-sm-6" type="submit">Next<span class="fas fa-chevron-right ms-2" data-fa-transform="shrink-3"> </span></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- diagnostics - start -->
                <div class="card mb-3 diagnostics-card">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Diagnósticos</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <div data-iframe="{{ route('emergency_services_diagnostics', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"></div>
                        
                        <div class="col-12 mt-2">
                            <button class="btn btn-primary btn-sm diagnostics-button" type="button"  title="Diagnósticos" iframe-form="{{ route('emergency_services_diagnostics.form', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}" iframe-create="{{ route('emergency_services_diagnostics.form.create', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}">Inserir</button>
                        </div>
                    </div>
                </div>

                <!-- guidelines - start -->
                <div class="card mb-3 ">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Orientações</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body bg-light">
                        <textarea class="form-control form-control-sm @error('guidelines') is-invalid @enderror" id="guidelines" name="guidelines" rows="3" placeholder="Observação">{{old('guidelines') ?? $medical_care->guidelines ?? ""}}</textarea>
                        <div class="valid-feedback">sucesso!</div>
                    </div>
                </div>

                <!-- Lesão Corporal - start -->
                <div class="card mb-3 ">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Lesão Corporal</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="aggression" id="label_aggression"><strong>Agressões:</strong></label><br/>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="aggression-y" name="aggression" @if(old('aggression') or (($medical_care) AND $medical_care->aggression == "y")) checked @endif value="y"/>
                                        <label class="form-check-label" for="aggression-y">Sim</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="aggression-n" name="aggression" @if((empty(old('aggression')) or empty(($medical_care))) OR old('aggression') or (($medical_care) AND $medical_care->aggression == "n")) checked @endif value="n"/>
                                        <label class="form-check-label" for="aggression-n">Não</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="firearm_aggression" id="label_firearm_aggression"><strong>Agressão com arma de fogo:</strong></label><br/>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="firearm_aggression-y" @if(old('firearm_aggression') or (($medical_care) AND $medical_care->firearm_aggression == "y")) checked @endif name="firearm_aggression" value="y"/>
                                        <label class="form-check-label" for="firearm_aggression-y">Sim</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="firearm_aggression-n" @if((empty(old('firearm_aggression')) or empty(($medical_care))) OR old('firearm_aggression') or (($medical_care) AND $medical_care->firearm_aggression == "n")) checked @endif name="firearm_aggression" value="n"/>
                                        <label class="form-check-label" for="firearm_aggression-n">Não</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="weapon_flaps" id="label_weapon_flaps"><strong>Agressão com arma branca:</strong></label><br/>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="weapon_flaps-y" @if(old('weapon_flaps') or (($medical_care) AND $medical_care->weapon_flaps == "y")) checked @endif name="weapon_flaps" value="y"/>
                                        <label class="form-check-label" for="weapon_flaps-y">Sim</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="weapon_flaps-n" @if((empty(old('weapon_flaps')) or empty(($medical_care))) OR old('weapon_flaps') or (($medical_care) AND $medical_care->weapon_flaps == "n")) checked @endif name="weapon_flaps" value="n"/>
                                        <label class="form-check-label" for="weapon_flaps-n">Não</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="self_extermination" id="label_self_extermination"><strong>Tentativa de auto extermínio:</strong></label><br/>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="self_extermination-y" @if(old('self_extermination') or (($medical_care) AND $medical_care->self_extermination == "y")) checked @endif name="self_extermination" value="y"/>
                                        <label class="form-check-label" for="self_extermination-y">Sim</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="self_extermination-n" @if((empty(old('self_extermination')) or empty(($medical_care))) OR old('self_extermination') or (($medical_care) AND $medical_care->self_extermination == "n")) checked @endif name="self_extermination" value="n"/>
                                        <label class="form-check-label" for="self_extermination-n">Não</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="sexual_violence" id="label_sexual_violence"><strong>Violência sexual:</strong></label><br/>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="sexual_violence-y" @if(old('sexual_violence') or (($medical_care) AND $medical_care->sexual_violence == "y")) checked @endif name="sexual_violence" value="y"/>
                                        <label class="form-check-label" for="sexual_violence-y">Sim</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="sexual_violence-n" @if((empty(old('sexual_violence')) or empty(($medical_care))) OR old('sexual_violence') or (($medical_care) AND $medical_care->sexual_violence == "n")) checked @endif name="sexual_violence" value="n"/>
                                        <label class="form-check-label" for="sexual_violence-n">Não</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="forensic_examination" id="label_forensic_examination"><strong>Realizado exame de corpo de delito:</strong></label><br/>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="forensic_examination-y" @if(old('forensic_examination') or (($medical_care) AND $medical_care->forensic_examination == "y")) checked @endif name="forensic_examination" value="y"/>
                                        <label class="form-check-label" for="forensic_examination-y">Sim</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="forensic_examination-n" @if((empty(old('forensic_examination')) or empty(($medical_care))) OR old('forensic_examination') or (($medical_care) AND $medical_care->forensic_examination == "n")) checked @endif name="forensic_examination" value="n"/>
                                        <label class="form-check-label" for="forensic_examination-n">Não</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- front desk -->
            <div class="data-front-desk block-item-class">
                @include('layouts/admin/fragments.screenings')
            </div>

            <!-- allergies diseases -->
            <div class="allergies-diseases block-item-class">
                    
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Alergias Doenças</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <div data-iframe="{{ route('users_diseases', ['type' => "a", 'IdUsers' => base64_encode($emergency_services->IdUsers)]) }}"></div>
                        
                        <div class="col-12 mt-2">
                            <button class="btn btn-primary btn-sm" type="button"  title="Alergias Doenças" iframe-form="{{ route('users_diseases.form', ['type' => "a", 'IdUsers' => base64_encode($emergency_services->IdUsers)]) }}" iframe-create="{{ route('users_diseases.form.create', ['type' => "a", 'IdUsers' => base64_encode($emergency_services->IdUsers)]) }}">Inserir</button>
                        </div>
                    </div>
                </div>
                
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Antecedentes</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <div data-iframe="{{ route('users_diseases', ['type' => "b", 'IdUsers' => base64_encode($emergency_services->IdUsers)]) }}"></div>
                        
                        <div class="col-12 mt-2">
                            <button class="btn btn-primary btn-sm" type="button"  title="Antecedentes" iframe-form="{{ route('users_diseases.form', ['type' => "b", 'IdUsers' => base64_encode($emergency_services->IdUsers)]) }}" iframe-create="{{ route('users_diseases.form.create', ['type' => "b", 'IdUsers' => base64_encode($emergency_services->IdUsers)]) }}">Inserir</button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- upload file -->
            <div class="data-upload block-item-class">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Arquivos</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <div data-iframe="{{ route('emergency_services_files', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"></div>
                        
                        <div class="col-12 mt-2">
                            <button class="btn btn-primary btn-sm" type="button" iframe-title="Novo Arquivo" url="{{ route('emergency_services_files.form', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}" title="Arquivos" data-iframe>Inserir</button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- registration data -->
            <div class="registration-data block-item-class">
                @include('layouts/admin/fragments.users')
            </div>

            <!-- historic -->
            <div class="data-historic block-item-class">

                <div class="card mb-3 diagnostics-card">
                    <div class="card-header">
                        <div class="row flex-between-end">
                            <div class="col-auto align-self-center">
                                <h5 class="mb-0">Histórico</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <div data-iframe="{{ route('emergency_services.historic', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]) }}"></div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</form>

@endsection

<!-- scripts - start -->
@section('scripts')

<script>
    @if(empty($medical_care))
        localStorage.setItem('block-item-select', '')
    @endif
</script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{ asset('admin/js/validate-additional-methods.js') }}"></script>
<script src="{{ asset('admin/js/validate-messages_pt_BR.js') }}"></script>
<script src="{{ asset('admin/js/maskedinput.js') }}"></script>
<script src="{{ asset('admin/js/inputmask.js') }}"></script>
<script src="{{ asset('admin/js/modules/medical_care.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/iframe-form.js') }}"></script>
<script src="{{ asset('admin/js/iframe.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/block-item.js') }}" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {

    //region - validação
	$("#form").validate({
		rules: {
            
		},
		messages: {

		},
		onkeyup: false,
		submitHandler: function(form) {

			$(this.submitButton).prop('disabled', true);
			form.submit();

		},
		errorElement: "label",
		errorPlacement: function (error, element) {
			//alert(JSON.stringify(error));
			error.addClass("invalid-feedback");
			if(element.parent().hasClass('input-group')){
				error.insertAfter( element.parent() );
			} else if (element.prop("type") === "checkbox") {
				error.insertAfter(element.next("label"));
			} else {
				error.insertAfter(element);
			}
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass("is-invalid");
            $(element).prop('required', true)
            validate_form()
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass("is-invalid");
			$("label[id='"+$(element).attr("id")+"-error']").remove(); // exclui o label já validade (padrao validate é display: none)

		},
		ignore: true
	});
	//endregion -  validação

})
</script>

@endsection
<!-- end - start -->