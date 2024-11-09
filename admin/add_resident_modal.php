    <!-- Insert resident data -->
    <div class="modal fade" id="createdata" tabindex="-1" aria-labelledby="createdataLabel" aria-hidden="true">
        <div class="row justify-content-center mb-3">
            <div class="col-lg-8 col-md-10 col-sm-12 mb-5">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Personal Information</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="action.php" method="POST">
                            <div class="modal-body">
                                <div class="form-floating mb-2">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Full Name" title="Insert full name" required>
                                    <label for="name">Full Name <sup>*</sup></label>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="number" name="age" class="form-control" id="age" placeholder="Age" title="Insert resident's age" required>
                                            <label for="age">Age <sup>*</sup></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="number" name="phone" class="form-control" id="phone" placeholder="Phone Number" title="Insert phone number" required>
                                            <label for="phone">Phone Number <small>(optional)</small></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="date" name="bday" class="form-control" id="bday" placeholder="Birthday" title="Insert birthday" required>
                                            <label for="bday">Birthday</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select class="form-select" name="gender" id="gender" title="Insert gender">
                                                <option hidden>--Please Select--</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Civil Status</label>
                                            <select class="form-select" name="status" id="status" title="Insert Civil Status" required>
                                                <option hidden>--Please Select--</option>
                                                <option value="single">Single</option>
                                                <option value="married">Married</option>
                                                <option value="widowed">Widowed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="place" class="form-control" id="place" title="Insert birth place" placeholder="Birth Place" required>
                                            <label for="place">Birth Place</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="stay" class="form-control" id="stay" placeholder="Years of Residency" title="Insert the year of residency" required>
                                            <label for="stay">Year of Residency <small>(since when)</small></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="postal">Postal Code</label>
                                            <select class="form-select" name="postal" id="postal" required title="Insert postal code">
                                                <option hidden>--Please Select--</option>
                                                <option value="3111">Aliaga, 3111</option>
                                                <option value="3128">Bongabon, 3128</option>
                                                <option value="3100">Cabanatuan City, 3100</option>
                                                <option value="3107">Cabiao, 3107</option>
                                                <option value="3123">Carranglan, 3123</option>
                                                <option value="3120">Central Luzon State University, 3120</option>
                                                <option value="3117">Cuyapo, 3117</option>
                                                <option value="3130">Fort Magsaysay, 3130</option>
                                                <option value="3131">Gabaldon, 3131</option>
                                                <option value="3105">Gapan, 3105</option>
                                                <option value="3125">General M. Natividad, 3125</option>
                                                <option value="3104">General Tinio, 3104</option>
                                                <option value="3115">Guimba, 3115</option>
                                                <option value="3109">Jaen, 3109</option>
                                                <option value="3129">Laur, 3129</option>
                                                <option value="3112">Licab, 3112</option>
                                                <option value="3126">Llanera, 3126</option>
                                                <option value="3122">Lupao, 3122</option>
                                                <option value="3119">Muñoz, 3119</option>
                                                <option value="3116">Nampicuan, 3116</option>
                                                <option value="3132">Palayan City, 3132</option>
                                                <option value="3124">Pantabangan, 3124</option>
                                                <option value="3103">Peñaranda, 3103</option>
                                                <option value="3113">Quezon, 3113</option>
                                                <option value="3127">Rizal, 3127</option>
                                                <option value="3108">San Antonio, 3108</option>
                                                <option value="3106">San Isidro, 3106</option>
                                                <option value="3121">San Jose City, 3121</option>
                                                <option value="3102">San Leonardo, 3102</option>
                                                <option value="3101">Santa Rosa, 3101</option>
                                                <option value="3133">Santo Domingo, 3133</option>
                                                <option value="3114">Talavera, 3114</option>
                                                <option value="3118">Talugtog, 3118</option>
                                                <option value="3110">Zaragosa, 3110</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="zone">Sitio/Purok</label>
                                            <select class="form-select" name="zone" id="zone" title="Insert purok" required>
                                                <option hidden>--Please Select--</option>
                                                <option value="Sitio Taktak">Sitio Taktak</option>
                                                <option value="Sitio Boring">Sitio Boring</option>
                                                <option value="Sitio Curva">Sitio Curva</option>
                                                <option value="Sitio Lahud">Sitio Lahud</option>
                                                <option value="Sitio Bukig">Sitio Bukig</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="barangay">Barangay</label>
                                            <select class="form-select" name="barangay" id="barangay" title="Insert barangay" required>
                                                <option hidden>--Please Select--</option>
                                                <option value="Bantug">Bantug</option>
                                                <option value="Bunga">Bunga</option>
                                                <option value="Burgos">Burgos</option>
                                                <option value="Capintalan">Capintalan</option>
                                                <option value="D. L. Maglanoc">D. L. Maglanoc</option>
                                                <option value="F. C. Otic">F. C. Otic</option>
                                                <option value="General Luna">General Luna</option>
                                                <option value="G. S. Rosario">G. S. Rosario</option>
                                                <option value="Joson">Joson</option>
                                                <option value="Minuli">Minuli</option>
                                                <option value="Piut">Piut</option>
                                                <option value="Puncan">Puncan</option>
                                                <option value="Putlan">Putlan</option>
                                                <option value="R.A. Padilla">R.A. Padilla</option>
                                                <option value="Salazar">Salazar</option>
                                                <option value="San Agustin">San Agustin</option>
                                                <option value="T. L. Padilla">T. L. Padilla</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="municipality">Municipality</label>
                                            <select class="form-select" name="municipality" id="municipality" title="Insert Municipality" required>
                                                <option hidden>--Please Select--</option>
                                                <option value="Aliaga">Aliaga</option>
                                                <option value="Bongabon">Bongabon</option>
                                                <option value="Cabanatuan">Cabanatuan</option>
                                                <option value="Cabiao">Cabiao</option>
                                                <option value="Carranglan">Carranglan</option>
                                                <option value="Cuyapo">Cuyapo</option>
                                                <option value="Gabaldon">Gabaldon</option>
                                                <option value="Gapan">Gapan</option>
                                                <option value="General Mamerto Natividad">General Mamerto Natividad</option>
                                                <option value="General Tinio">General Tinio</option>
                                                <option value="Guimba">Guimba</option>
                                                <option value="Jaen">Jaen</option>
                                                <option value="Laur">Laur</option>
                                                <option value="Licab">Licab</option>
                                                <option value="Llanera">Llanera</option>
                                                <option value="Lupao">Lupao</option>
                                                <option value="Nampicuan">Nampicuan</option>
                                                <option value="Palayan">Palayan</option>
                                                <option value="Pantabangan">Pantabangan</option>
                                                <option value="Peñaranda">Peñaranda</option>
                                                <option value="Quezon">Quezon</option>
                                                <option value="Rizal">Rizal</option>
                                                <option value="San Antonio">San Antonio</option>
                                                <option value="San Isidro">San Isidro</option>
                                                <option value="San Jose">San Jose</option>
                                                <option value="San Leonardo">San Leonardo</option>
                                                <option value="Santa Rosa">Santa Rosa</option>
                                                <option value="Sto. Domingo">Sto. Domingo</option>
                                                <option value="Science City of Munoz">Science City of Munoz</option>
                                                <option value="Talavera">Talavera</option>
                                                <option value="Talugtug">Talugtug</option>
                                                <option value="Zaragoza">Zaragoza</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="province">Province</label>
                                            <select class="form-select" name="province" id="province" title="Insert Province" required>
                                                <option hidden>--Please Select--</option>
                                                <option value="Abra">Abra</option>
                                                <option value="Agusan del Norte">Agusan del Norte</option>
                                                <option value="Agusan del Sur">Agusan del Sur</option>
                                                <option value="Aklan">Aklan</option>
                                                <option value="Albay">Albay</option>
                                                <option value="Antique">Antique</option>
                                                <option value="Apayao">Apayao</option>
                                                <option value="Aurora">Aurora</option>
                                                <option value="Basilan">Basilan</option>
                                                <option value="Bataan">Bataan</option>
                                                <option value="Batanes">Batanes</option>
                                                <option value="Batangas">Batangas</option>
                                                <option value="Benguet">Benguet</option>
                                                <option value="Bohol">Bohol</option>
                                                <option value="Bukidnon">Bukidnon</option>
                                                <option value="Bulacan">Bulacan</option>
                                                <option value="Cagayan">Cagayan</option>
                                                <option value="Camarines Norte">Camarines Norte</option>
                                                <option value="Camarines Sur">Camarines Sur</option>
                                                <option value="Camiguin">Camiguin</option>
                                                <option value="Capiz">Capiz</option>
                                                <option value="Catanduanes">Catanduanes</option>
                                                <option value="Cavite">Cavite</option>
                                                <option value="Cebu">Cebu</option>
                                                <option value="Compostela Valley">Compostela Valley</option>
                                                <option value="Cotabato">Cotabato</option>
                                                <option value="Davao de Oro">Davao de Oro</option>
                                                <option value="Davao del Norte">Davao del Norte</option>
                                                <option value="Davao del Sur">Davao del Sur</option>
                                                <option value="Davao Occidental">Davao Occidental</option>
                                                <option value="Eastern Samar">Eastern Samar</option>
                                                <option value="Guimaras">Guimaras</option>
                                                <option value="Ifugao">Ifugao</option>
                                                <option value="Ilocos Norte">Ilocos Norte</option>
                                                <option value="Ilocos Sur">Ilocos Sur</option>
                                                <option value="Iloilo">Iloilo</option>
                                                <option value="Isabela">Isabela</option>
                                                <option value="Kalinga">Kalinga</option>
                                                <option value="Kamisato">Kamisato</option>
                                                <option value="La Union">La Union</option>
                                                <option value="Laguna">Laguna</option>
                                                <option value="Leyte">Leyte</option>
                                                <option value="Maguindanao">Maguindanao</option>
                                                <option value="Marinduque">Marinduque</option>
                                                <option value="Masbate">Masbate</option>
                                                <option value="Misamis Occidental">Misamis Occidental</option>
                                                <option value="Misamis Oriental">Misamis Oriental</option>
                                                <option value="Mountain Province">Mountain Province</option>
                                                <option value="Negros Occidental">Negros Occidental</option>
                                                <option value="Negros Oriental">Negros Oriental</option>
                                                <option value="Northern Samar">Northern Samar</option>
                                                <option value="Nueva Ecija">Nueva Ecija</option>
                                                <option value="Nueva Vizcaya">Nueva Vizcaya</option>
                                                <option value="Occidental Mindoro">Occidental Mindoro</option>
                                                <option value="Oriental Mindoro">Oriental Mindoro</option>
                                                <option value="Palawan">Palawan</option>
                                                <option value="Pampanga">Pampanga</option>
                                                <option value="Pangasinan">Pangasinan</option>
                                                <option value="Quezon">Quezon</option>
                                                <option value="Quirino">Quirino</option>
                                                <option value="Rizal">Rizal</option>
                                                <option value="Romblon">Romblon</option>
                                                <option value="Samar">Samar</option>
                                                <option value="Sarangani">Sarangani</option>
                                                <option value="Siquijor">Siquijor</option>
                                                <option value="Sorsogon">Sorsogon</option>
                                                <option value="South Cotabato">South Cotabato</option>
                                                <option value="Southern Leyte">Southern Leyte</option>
                                                <option value="Sultan Kudarat">Sultan Kudarat</option>
                                                <option value="Sulu">Sulu</option>
                                                <option value="Surigao del Norte">Surigao del Norte</option>
                                                <option value="Surigao del Sur">Surigao del Sur</option>
                                                <option value="Tarlac">Tarlac</option>
                                                <option value="Zambales">Zambales</option>
                                                <option value="Zamboanga del Norte">Zamboanga del Norte</option>
                                                <option value="Zamboanga del Sur">Zamboanga del Sur</option>
                                                <option value="Zamboanga Sibugay">Zamboanga Sibugay</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="mother_name" class="form-control" id="mother_name" title="Insert Mother Name" placeholder="Mother's Name" required>
                                            <label for="mother_name">Mother's Name <sup>(<i>Write deceased if dead</i>)</sup></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="father_name" class="form-control" id="father_name" title="Insert Father Name" placeholder="Father's Name" required>
                                            <label for="father_name">Father's Name <sup>(<i>Write deceased if dead</i>)</sup></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="pendingcase">Do you have any pending cases?</label>
                                    <select name="pendingcase" id="pendingcase" class="form-select">
                                        <option hidden value="">Select an option</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                    <div id="detailsSection" style="display: none;">
                                        <label for="caseDetails">If yes, please provide details:</label>
                                        <textarea id="caseDetails" name="caseDetails" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="inputUser" class="btn btn-primary w-100 fw-bold mb-2" title="Press this to add to the list">Add Resident</button>
                                    <button class="btn btn-danger w-100 fw-bold" data-bs-dismiss="modal" title="Press this if you want to close">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Insert Resident data -->