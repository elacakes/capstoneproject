<?php
include "../conn.php";
include "../assets/function.php";
include "includes/header.php";
include "includes/navbar.php";

if (isset($_SESSION['status'])) {
    echo "<script>alert('" . $_SESSION['status'] . "');</script>";
    unset($_SESSION['status']);
}
?>

<section class="container mt-5">
    <a href="dashboard.php" class="btn mb-3" style="background-color: #a7c6ed; border-color: #a7c6ed;">
        <i class="bi bi-arrow-left-circle-fill" style="font-size: 1.2rem; color: #0056b3;"></i> Dashboard
    </a>
    <div class="row justify-content-center">
        <div class="col-12 col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-person-fill" style="font-size: 2rem; color: #007bff;"></i>
                    <h5 class="card-title mt-3">Personal Information</h5>
                    <p class="card-text">Update your personal information easily.</p>
                    <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateData">Update Now</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-lock-fill" style="font-size: 2rem; color: #28a745;"></i>
                    <h5 class="card-title mt-3">Password & Security</h5>
                    <p class="card-text">Change your password to keep your account secure.</p>
                    <a type="button" class="btn btn-success" title="Change Password" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</a>
                </div>
            </div>
        </div>
    </div>
</section>

</section>
<!-- Update Information -->
<?php
$user_id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found.";
    exit();
}
?>
<div class="modal fade" id="updateData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fw-bold mb-2 mt-0 fs-5" id="updateDataLabel">Update your Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="action.php" method="POST">
                    <?php alertMessage('green'); ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">

                                <input type="text" name="name" class="form-control" id="name" value="<?php echo $user['name']; ?>" placeholder="Full Name" required>
                                <label for="name">Full Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" name="email" class="form-control" title="Update your email" id="email" value="<?php echo $user['email']; ?>" placeholder="Email Address" required>
                                <label for="email">Email Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" name="age" class="form-control" id="age" value="<?php echo $user['age']; ?>" placeholder="Age" required>
                                <label for="age">Age</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" name="phone" class="form-control" id="phone" value="<?php echo $user['phone']; ?>" placeholder="Phone Number" required>
                                <label for="phone">Phone Number <small>(optional)</small></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="date" name="bday" class="form-control" id="bday" value="<?php echo $user['bday']; ?>" placeholder="Birthday" required>
                                <label for="bday">Birthday</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-select" name="gender" id="gender">
                                    <option hidden>--Please Select--</option>
                                    <option value="Male" <?php echo ($user['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                                    <option value="Female" <?php echo ($user['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Civil Status</label>
                                <select class="form-select" name="status" id="status" required>
                                    <option hidden>--Please Select--</option>
                                    <option value="single" <?php echo ($user['status'] == 'single') ? 'selected' : ''; ?>>Single</option>
                                    <option value="married" <?php echo ($user['status'] == 'married') ? 'selected' : ''; ?>>Married</option>
                                    <option value="widowed" <?php echo ($user['status'] == 'widowed') ? 'selected' : ''; ?>>Widowed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="place" class="form-control" id="place" value="<?php echo $user['place']; ?>" placeholder="Birth Place" required>
                                <label for="place">Birth Place</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="stay" class="form-control" id="stay" value="<?php echo $user['stay']; ?>" placeholder="Years of Residency" required>
                                <label for="stay">Year of Residency</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="postal">Postal Code</label>
                                <select class="form-select" name="postal" id="postal" required>
                                    <option hidden>--Please Select--</option>
                                    <option value="3111" <?php echo ($user['postal'] == '3111') ? 'selected' : ''; ?>>Aliaga, 3111</option>
                                    <option value="3128" <?php echo ($user['postal'] == '3128') ? 'selected' : ''; ?>>Bongabon, 3128</option>
                                    <option value="3100" <?php echo ($user['postal'] == '3100') ? 'selected' : ''; ?>>Cabanatuan City, 3100</option>
                                    <option value="3107" <?php echo ($user['postal'] == '3107') ? 'selected' : ''; ?>>Cabiao, 3107</option>
                                    <option value="3123" <?php echo ($user['postal'] == '3123') ? 'selected' : ''; ?>>Carranglan, 3123</option>
                                    <option value="3120" <?php echo ($user['postal'] == '3120') ? 'selected' : ''; ?>>Central Luzon State University, 3120</option>
                                    <option value="3117" <?php echo ($user['postal'] == '3117') ? 'selected' : ''; ?>>Cuyapo, 3117</option>
                                    <option value="3130" <?php echo ($user['postal'] == '3130') ? 'selected' : ''; ?>>Fort Magsaysay, 3130</option>
                                    <option value="3131" <?php echo ($user['postal'] == '3131') ? 'selected' : ''; ?>>Gabaldon, 3131</option>
                                    <option value="3105" <?php echo ($user['postal'] == '3105') ? 'selected' : ''; ?>>Gapan, 3105</option>
                                    <option value="3125" <?php echo ($user['postal'] == '3125') ? 'selected' : ''; ?>>General M. Natividad, 3125</option>
                                    <option value="3104" <?php echo ($user['postal'] == '3104') ? 'selected' : ''; ?>>General Tinio, 3104</option>
                                    <option value="3115" <?php echo ($user['postal'] == '3115') ? 'selected' : ''; ?>>Guimba, 3115</option>
                                    <option value="3109" <?php echo ($user['postal'] == '3109') ? 'selected' : ''; ?>>Jaen, 3109</option>
                                    <option value="3129" <?php echo ($user['postal'] == '3129') ? 'selected' : ''; ?>>Laur, 3129</option>
                                    <option value="3112" <?php echo ($user['postal'] == '3112') ? 'selected' : ''; ?>>Licab, 3112</option>
                                    <option value="3126" <?php echo ($user['postal'] == '3126') ? 'selected' : ''; ?>>Llanera, 3126</option>
                                    <option value="3122" <?php echo ($user['postal'] == '3122') ? 'selected' : ''; ?>>Lupao, 3122</option>
                                    <option value="3119" <?php echo ($user['postal'] == '3119') ? 'selected' : ''; ?>>Muñoz, 3119</option>
                                    <option value="3116" <?php echo ($user['postal'] == '3116') ? 'selected' : ''; ?>>Nampicuan, 3116</option>
                                    <option value="3132" <?php echo ($user['postal'] == '3132') ? 'selected' : ''; ?>>Palayan City, 3132</option>
                                    <option value="3124" <?php echo ($user['postal'] == '3124') ? 'selected' : ''; ?>>Pantabangan, 3124</option>
                                    <option value="3103" <?php echo ($user['postal'] == '3103') ? 'selected' : ''; ?>>Peñaranda, 3103</option>
                                    <option value="3113" <?php echo ($user['postal'] == '3113') ? 'selected' : ''; ?>>Quezon, 3113</option>
                                    <option value="3127" <?php echo ($user['postal'] == '3127') ? 'selected' : ''; ?>>Rizal, 3127</option>
                                    <option value="3108" <?php echo ($user['postal'] == '3108') ? 'selected' : ''; ?>>San Antonio, 3108</option>
                                    <option value="3106" <?php echo ($user['postal'] == '3106') ? 'selected' : ''; ?>>San Isidro, 3106</option>
                                    <option value="3121" <?php echo ($user['postal'] == '3121') ? 'selected' : ''; ?>>San Jose City, 3121</option>
                                    <option value="3102" <?php echo ($user['postal'] == '3102') ? 'selected' : ''; ?>>San Leonardo, 3102</option>
                                    <option value="3101" <?php echo ($user['postal'] == '3101') ? 'selected' : ''; ?>>Santa Rosa, 3101</option>
                                    <option value="3133" <?php echo ($user['postal'] == '3133') ? 'selected' : ''; ?>>Santo Domingo, 3133</option>
                                    <option value="3114" <?php echo ($user['postal'] == '3114') ? 'selected' : ''; ?>>Talavera, 3114</option>
                                    <option value="3118" <?php echo ($user['postal'] == '3118') ? 'selected' : ''; ?>>Talugtog, 3118</option>
                                    <option value="3110" <?php echo ($user['postal'] == '3110') ? 'selected' : ''; ?>>Zaragosa, 3110</option>
                                </select>

                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="zone">Sitio/Purok</label>
                                <select class="form-select" name="zone" id="zone" required>
                                    <option hidden>--Please Select--</option>
                                    <option value="Sitio Taktak" <?php echo ($user['zone'] == 'Sitio Taktak') ? 'selected' : ''; ?>>Sitio Taktak</option>
                                    <option value="Sitio Boring" <?php echo ($user['zone'] == 'Sitio Boring') ? 'selected' : ''; ?>>Sitio Boring</option>
                                    <option value="Sitio Curva" <?php echo ($user['zone'] == 'Sitio Curva') ? 'selected' : ''; ?>>Sitio Curva</option>
                                    <option value="Sitio Lahud" <?php echo ($user['zone'] == 'Sitio Lahud') ? 'selected' : ''; ?>>Sitio Lahud</option>
                                    <option value="Sitio Bukig" <?php echo ($user['zone'] == 'Sitio Bukig') ? 'selected' : ''; ?>>Sitio Bukig</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="barangay">Barangay</label>
                                <select class="form-select" name="barangay" id="barangay" required>
                                    <option hidden>--Please Select--</option>
                                    <option value="Bantug" <?php echo ($user['barangay'] == 'Bantug') ? 'selected' : ''; ?>>Bantug</option>
                                    <option value="Bunga" <?php echo ($user['barangay'] == 'Bunga') ? 'selected' : ''; ?>>Bunga</option>
                                    <option value="Burgos" <?php echo ($user['barangay'] == 'Burgos') ? 'selected' : ''; ?>>Burgos</option>
                                    <option value="Capintalan" <?php echo ($user['barangay'] == 'Capintalan') ? 'selected' : ''; ?>>Capintalan</option>
                                    <option value="D. L. Maglanoc" <?php echo ($user['barangay'] == 'D. L. Maglanoc') ? 'selected' : ''; ?>>D. L. Maglanoc</option>
                                    <option value="F. C. Otic" <?php echo ($user['barangay'] == 'F. C. Otic') ? 'selected' : ''; ?>>F. C. Otic</option>
                                    <option value="General Luna" <?php echo ($user['barangay'] == 'General Luna') ? 'selected' : ''; ?>>General Luna</option>
                                    <option value="G. S. Rosario" <?php echo ($user['barangay'] == 'G. S. Rosario') ? 'selected' : ''; ?>>G. S. Rosario</option>
                                    <option value="Joson" <?php echo ($user['barangay'] == 'Joson') ? 'selected' : ''; ?>>Joson</option>
                                    <option value="Minuli" <?php echo ($user['barangay'] == 'Minuli') ? 'selected' : ''; ?>>Minuli</option>
                                    <option value="Piut" <?php echo ($user['barangay'] == 'Piut') ? 'selected' : ''; ?>>Piut</option>
                                    <option value="Puncan" <?php echo ($user['barangay'] == 'Puncan') ? 'selected' : ''; ?>>Puncan</option>
                                    <option value="Putlan" <?php echo ($user['barangay'] == 'Putlan') ? 'selected' : ''; ?>>Putlan</option>
                                    <option value="R.A. Padilla" <?php echo ($user['barangay'] == 'R.A. Padilla') ? 'selected' : ''; ?>>R.A. Padilla</option>
                                    <option value="Salazar" <?php echo ($user['barangay'] == 'Salazar') ? 'selected' : ''; ?>>Salazar</option>
                                    <option value="San Agustin" <?php echo ($user['barangay'] == 'San Agustin') ? 'selected' : ''; ?>>San Agustin</option>
                                    <option value="T. L. Padilla" <?php echo ($user['barangay'] == 'T. L. Padilla') ? 'selected' : ''; ?>>T. L. Padilla</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="municipality">Municipality</label>
                                <select class="form-select" name="municipality" id="municipality" required>
                                    <option hidden>--Please Select--</option>
                                    <option value="Aliaga" <?php echo ($user['municipality'] == 'Aliaga') ? 'selected' : ''; ?>>Aliaga</option>
                                    <option value="Bongabon" <?php echo ($user['municipality'] == 'Bongabon') ? 'selected' : ''; ?>>Bongabon</option>
                                    <option value="Cabanatuan" <?php echo ($user['municipality'] == 'Cabanatuan') ? 'selected' : ''; ?>>Cabanatuan</option>
                                    <option value="Cabiao" <?php echo ($user['municipality'] == 'Cabiao') ? 'selected' : ''; ?>>Cabiao</option>
                                    <option value="Carranglan" <?php echo ($user['municipality'] == 'Carranglan') ? 'selected' : ''; ?>>Carranglan</option>
                                    <option value="Cuyapo" <?php echo ($user['municipality'] == 'Cuyapo') ? 'selected' : ''; ?>>Cuyapo</option>
                                    <option value="Gabaldon" <?php echo ($user['municipality'] == 'Gabaldon') ? 'selected' : ''; ?>>Gabaldon</option>
                                    <option value="Gapan" <?php echo ($user['municipality'] == 'Gapan') ? 'selected' : ''; ?>>Gapan</option>
                                    <option value="General Mamerto Natividad" <?php echo ($user['municipality'] == 'General Mamerto Natividad') ? 'selected' : ''; ?>>General Mamerto Natividad</option>
                                    <option value="General Tinio" <?php echo ($user['municipality'] == 'General Tinio') ? 'selected' : ''; ?>>General Tinio</option>
                                    <option value="Guimba" <?php echo ($user['municipality'] == 'Guimba') ? 'selected' : ''; ?>>Guimba</option>
                                    <option value="Jaen" <?php echo ($user['municipality'] == 'Jaen') ? 'selected' : ''; ?>>Jaen</option>
                                    <option value="Laur" <?php echo ($user['municipality'] == 'Laur') ? 'selected' : ''; ?>>Laur</option>
                                    <option value="Licab" <?php echo ($user['municipality'] == 'Licab') ? 'selected' : ''; ?>>Licab</option>
                                    <option value="Llanera" <?php echo ($user['municipality'] == 'Llanera') ? 'selected' : ''; ?>>Llanera</option>
                                    <option value="Lupao" <?php echo ($user['municipality'] == 'Lupao') ? 'selected' : ''; ?>>Lupao</option>
                                    <option value="Nampicuan" <?php echo ($user['municipality'] == 'Nampicuan') ? 'selected' : ''; ?>>Nampicuan</option>
                                    <option value="Palayan" <?php echo ($user['municipality'] == 'Palayan') ? 'selected' : ''; ?>>Palayan</option>
                                    <option value="Pantabangan" <?php echo ($user['municipality'] == 'Pantabangan') ? 'selected' : ''; ?>>Pantabangan</option>
                                    <option value="Peñaranda" <?php echo ($user['municipality'] == 'Peñaranda') ? 'selected' : ''; ?>>Peñaranda</option>
                                    <option value="Quezon" <?php echo ($user['municipality'] == 'Quezon') ? 'selected' : ''; ?>>Quezon</option>
                                    <option value="Rizal" <?php echo ($user['municipality'] == 'Rizal') ? 'selected' : ''; ?>>Rizal</option>
                                    <option value="San Antonio" <?php echo ($user['municipality'] == 'San Antonio') ? 'selected' : ''; ?>>San Antonio</option>
                                    <option value="San Isidro" <?php echo ($user['municipality'] == 'San Isidro') ? 'selected' : ''; ?>>San Isidro</option>
                                    <option value="San Jose" <?php echo ($user['municipality'] == 'San Jose') ? 'selected' : ''; ?>>San Jose</option>
                                    <option value="San Leonardo" <?php echo ($user['municipality'] == 'San Leonardo') ? 'selected' : ''; ?>>San Leonardo</option>
                                    <option value="Santa Rosa" <?php echo ($user['municipality'] == 'Santa Rosa') ? 'selected' : ''; ?>>Santa Rosa</option>
                                    <option value="Sto. Domingo" <?php echo ($user['municipality'] == 'Sto. Domingo') ? 'selected' : ''; ?>>Sto. Domingo</option>
                                    <option value="Science City of Munoz" <?php echo ($user['municipality'] == 'Science City of Munoz') ? 'selected' : ''; ?>>Science City of Munoz</option>
                                    <option value="Talavera" <?php echo ($user['municipality'] == 'Talavera') ? 'selected' : ''; ?>>Talavera</option>
                                    <option value="Talugtug" <?php echo ($user['municipality'] == 'Talugtug') ? 'selected' : ''; ?>>Talugtug</option>
                                    <option value="Zaragoza" <?php echo ($user['municipality'] == 'Zaragoza') ? 'selected' : ''; ?>>Zaragoza</option>
                                </select>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="province">Province</label>
                                <select class="form-select" name="province" id="province" required>
                                    <option hidden>--Please Select--</option>
                                    <option value="Abra" <?php echo ($user['province'] == 'Abra') ? 'selected' : ''; ?>>Abra</option>
                                    <option value="Agusan del Norte" <?php echo ($user['province'] == 'Agusan del Norte') ? 'selected' : ''; ?>>Agusan del Norte</option>
                                    <option value="Agusan del Sur" <?php echo ($user['province'] == 'Agusan del Sur') ? 'selected' : ''; ?>>Agusan del Sur</option>
                                    <option value="Aklan" <?php echo ($user['province'] == 'Aklan') ? 'selected' : ''; ?>>Aklan</option>
                                    <option value="Albay" <?php echo ($user['province'] == 'Albay') ? 'selected' : ''; ?>>Albay</option>
                                    <option value="Antique" <?php echo ($user['province'] == 'Antique') ? 'selected' : ''; ?>>Antique</option>
                                    <option value="Apayao" <?php echo ($user['province'] == 'Apayao') ? 'selected' : ''; ?>>Apayao</option>
                                    <option value="Aurora" <?php echo ($user['province'] == 'Aurora') ? 'selected' : ''; ?>>Aurora</option>
                                    <option value="Basilan" <?php echo ($user['province'] == 'Basilan') ? 'selected' : ''; ?>>Basilan</option>
                                    <option value="Bataan" <?php echo ($user['province'] == 'Bataan') ? 'selected' : ''; ?>>Bataan</option>
                                    <option value="Batanes" <?php echo ($user['province'] == 'Batanes') ? 'selected' : ''; ?>>Batanes</option>
                                    <option value="Batangas" <?php echo ($user['province'] == 'Batangas') ? 'selected' : ''; ?>>Batangas</option>
                                    <option value="Benguet" <?php echo ($user['province'] == 'Benguet') ? 'selected' : ''; ?>>Benguet</option>
                                    <option value="Bohol" <?php echo ($user['province'] == 'Bohol') ? 'selected' : ''; ?>>Bohol</option>
                                    <option value="Bukidnon" <?php echo ($user['province'] == 'Bukidnon') ? 'selected' : ''; ?>>Bukidnon</option>
                                    <option value="Bulacan" <?php echo ($user['province'] == 'Bulacan') ? 'selected' : ''; ?>>Bulacan</option>
                                    <option value="Cagayan" <?php echo ($user['province'] == 'Cagayan') ? 'selected' : ''; ?>>Cagayan</option>
                                    <option value="Camarines Norte" <?php echo ($user['province'] == 'Camarines Norte') ? 'selected' : ''; ?>>Camarines Norte</option>
                                    <option value="Camarines Sur" <?php echo ($user['province'] == 'Camarines Sur') ? 'selected' : ''; ?>>Camarines Sur</option>
                                    <option value="Camiguin" <?php echo ($user['province'] == 'Camiguin') ? 'selected' : ''; ?>>Camiguin</option>
                                    <option value="Capiz" <?php echo ($user['province'] == 'Capiz') ? 'selected' : ''; ?>>Capiz</option>
                                    <option value="Catanduanes" <?php echo ($user['province'] == 'Catanduanes') ? 'selected' : ''; ?>>Catanduanes</option>
                                    <option value="Cavite" <?php echo ($user['province'] == 'Cavite') ? 'selected' : ''; ?>>Cavite</option>
                                    <option value="Cebu" <?php echo ($user['province'] == 'Cebu') ? 'selected' : ''; ?>>Cebu</option>
                                    <option value="Compostela Valley" <?php echo ($user['province'] == 'Compostela Valley') ? 'selected' : ''; ?>>Compostela Valley</option>
                                    <option value="Cotabato" <?php echo ($user['province'] == 'Cotabato') ? 'selected' : ''; ?>>Cotabato</option>
                                    <option value="Davao de Oro" <?php echo ($user['province'] == 'Davao de Oro') ? 'selected' : ''; ?>>Davao de Oro</option>
                                    <option value="Davao del Norte" <?php echo ($user['province'] == 'Davao del Norte') ? 'selected' : ''; ?>>Davao del Norte</option>
                                    <option value="Davao del Sur" <?php echo ($user['province'] == 'Davao del Sur') ? 'selected' : ''; ?>>Davao del Sur</option>
                                    <option value="Davao Occidental" <?php echo ($user['province'] == 'Davao Occidental') ? 'selected' : ''; ?>>Davao Occidental</option>
                                    <option value="Eastern Samar" <?php echo ($user['province'] == 'Eastern Samar') ? 'selected' : ''; ?>>Eastern Samar</option>
                                    <option value="Guimaras" <?php echo ($user['province'] == 'Guimaras') ? 'selected' : ''; ?>>Guimaras</option>
                                    <option value="Ifugao" <?php echo ($user['province'] == 'Ifugao') ? 'selected' : ''; ?>>Ifugao</option>
                                    <option value="Ilocos Norte" <?php echo ($user['province'] == 'Ilocos Norte') ? 'selected' : ''; ?>>Ilocos Norte</option>
                                    <option value="Ilocos Sur" <?php echo ($user['province'] == 'Ilocos Sur') ? 'selected' : ''; ?>>Ilocos Sur</option>
                                    <option value="Iloilo" <?php echo ($user['province'] == 'Iloilo') ? 'selected' : ''; ?>>Iloilo</option>
                                    <option value="Isabela" <?php echo ($user['province'] == 'Isabela') ? 'selected' : ''; ?>>Isabela</option>
                                    <option value="Kalinga" <?php echo ($user['province'] == 'Kalinga') ? 'selected' : ''; ?>>Kalinga</option>
                                    <option value="Kamisato" <?php echo ($user['province'] == 'Kamisato') ? 'selected' : ''; ?>>Kamisato</option>
                                    <option value="La Union" <?php echo ($user['province'] == 'La Union') ? 'selected' : ''; ?>>La Union</option>
                                    <option value="Laguna" <?php echo ($user['province'] == 'Laguna') ? 'selected' : ''; ?>>Laguna</option>
                                    <option value="Leyte" <?php echo ($user['province'] == 'Leyte') ? 'selected' : ''; ?>>Leyte</option>
                                    <option value="Maguindanao" <?php echo ($user['province'] == 'Maguindanao') ? 'selected' : ''; ?>>Maguindanao</option>
                                    <option value="Marinduque" <?php echo ($user['province'] == 'Marinduque') ? 'selected' : ''; ?>>Marinduque</option>
                                    <option value="Masbate" <?php echo ($user['province'] == 'Masbate') ? 'selected' : ''; ?>>Masbate</option>
                                    <option value="Misamis Occidental" <?php echo ($user['province'] == 'Misamis Occidental') ? 'selected' : ''; ?>>Misamis Occidental</option>
                                    <option value="Misamis Oriental" <?php echo ($user['province'] == 'Misamis Oriental') ? 'selected' : ''; ?>>Misamis Oriental</option>
                                    <option value="Mountain Province" <?php echo ($user['province'] == 'Mountain Province') ? 'selected' : ''; ?>>Mountain Province</option>
                                    <option value="Negros Occidental" <?php echo ($user['province'] == 'Negros Occidental') ? 'selected' : ''; ?>>Negros Occidental</option>
                                    <option value="Negros Oriental" <?php echo ($user['province'] == 'Negros Oriental') ? 'selected' : ''; ?>>Negros Oriental</option>
                                    <option value="Northern Samar" <?php echo ($user['province'] == 'Northern Samar') ? 'selected' : ''; ?>>Northern Samar</option>
                                    <option value="Nueva Ecija" <?php echo ($user['province'] == 'Nueva Ecija') ? 'selected' : ''; ?>>Nueva Ecija</option>
                                    <option value="Nueva Vizcaya" <?php echo ($user['province'] == 'Nueva Vizcaya') ? 'selected' : ''; ?>>Nueva Vizcaya</option>
                                    <option value="Occidental Mindoro" <?php echo ($user['province'] == 'Occidental Mindoro') ? 'selected' : ''; ?>>Occidental Mindoro</option>
                                    <option value="Oriental Mindoro" <?php echo ($user['province'] == 'Oriental Mindoro') ? 'selected' : ''; ?>>Oriental Mindoro</option>
                                    <option value="Palawan" <?php echo ($user['province'] == 'Palawan') ? 'selected' : ''; ?>>Palawan</option>
                                    <option value="Pampanga" <?php echo ($user['province'] == 'Pampanga') ? 'selected' : ''; ?>>Pampanga</option>
                                    <option value="Pangasinan" <?php echo ($user['province'] == 'Pangasinan') ? 'selected' : ''; ?>>Pangasinan</option>
                                    <option value="Quezon" <?php echo ($user['province'] == 'Quezon') ? 'selected' : ''; ?>>Quezon</option>
                                    <option value="Quirino" <?php echo ($user['province'] == 'Quirino') ? 'selected' : ''; ?>>Quirino</option>
                                    <option value="Rizal" <?php echo ($user['province'] == 'Rizal') ? 'selected' : ''; ?>>Rizal</option>
                                    <option value="Romblon" <?php echo ($user['province'] == 'Romblon') ? 'selected' : ''; ?>>Romblon</option>
                                    <option value="Samar" <?php echo ($user['province'] == 'Samar') ? 'selected' : ''; ?>>Samar</option>
                                    <option value="Sarangani" <?php echo ($user['province'] == 'Sarangani') ? 'selected' : ''; ?>>Sarangani</option>
                                    <option value="Siquijor" <?php echo ($user['province'] == 'Siquijor') ? 'selected' : ''; ?>>Siquijor</option>
                                    <option value="Sorsogon" <?php echo ($user['province'] == 'Sorsogon') ? 'selected' : ''; ?>>Sorsogon</option>
                                    <option value="South Cotabato" <?php echo ($user['province'] == 'South Cotabato') ? 'selected' : ''; ?>>South Cotabato</option>
                                    <option value="Southern Leyte" <?php echo ($user['province'] == 'Southern Leyte') ? 'selected' : ''; ?>>Southern Leyte</option>
                                    <option value="Sultan Kudarat" <?php echo ($user['province'] == 'Sultan Kudarat') ? 'selected' : ''; ?>>Sultan Kudarat</option>
                                    <option value="Sulu" <?php echo ($user['province'] == 'Sulu') ? 'selected' : ''; ?>>Sulu</option>
                                    <option value="Surigao del Norte" <?php echo ($user['province'] == 'Surigao del Norte') ? 'selected' : ''; ?>>Surigao del Norte</option>
                                    <option value="Surigao del Sur" <?php echo ($user['province'] == 'Surigao del Sur') ? 'selected' : ''; ?>>Surigao del Sur</option>
                                    <option value="Tarlac" <?php echo ($user['province'] == 'Tarlac') ? 'selected' : ''; ?>>Tarlac</option>
                                    <option value="Zambales" <?php echo ($user['province'] == 'Zambales') ? 'selected' : ''; ?>>Zambales</option>
                                    <option value="Zamboanga del Norte" <?php echo ($user['province'] == 'Zamboanga del Norte') ? 'selected' : ''; ?>>Zamboanga del Norte</option>
                                    <option value="Zamboanga del Sur" <?php echo ($user['province'] == 'Zamboanga del Sur') ? 'selected' : ''; ?>>Zamboanga del Sur</option>
                                    <option value="Zamboanga Sibugay" <?php echo ($user['province'] == 'Zamboanga Sibugay') ? 'selected' : ''; ?>>Zamboanga Sibugay</option>
                                </select>

                            </div>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="mother_name" class="form-control" id="mother_name" value="<?php echo $user['mother_name']; ?>" placeholder="Mother's Name" required>
                                <small class="text-danger">(<i>Write deceased if dead</i>)</small>
                                <label for="mother_name">Mother's Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="father_name" class="form-control" id="father_name" value="<?php echo $user['father_name']; ?>" placeholder="Father's Name" required>
                                <small class="text-danger">(<i>Write deceased if dead</i>)</small>
                                <label for="father_name">Father's Name</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pendingcase">Do you have any pending cases?</label>
                        <select name="pendingcase" id="pendingcase" class="form-select" onchange="toggleDetailsSection()">
                            <option hidden value="">Select an option</option>
                            <option value="yes" <?php echo ($user['pendingcase'] == 'yes') ? 'selected' : ''; ?>>Yes</option>
                            <option value="no" <?php echo ($user['pendingcase'] == 'no') ? 'selected' : ''; ?>>No</option>
                        </select>
                        <div id="detailsSection" style="display: none;">
                            <label for="caseDetails">If yes, please provide details:</label>
                            <textarea id="caseDetails" name="caseDetails" rows="4" class="form-control"><?php echo isset($user['caseDetails']) ? htmlspecialchars($user['caseDetails']) : ''; ?></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="update_info" class="btn btn-primary w-100 fw-bold mb-1">Save Info</button>
                        <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "change-pass.php"; ?>

<script>
    function toggleDetailsSection() {
        var pendingCaseSelect = document.getElementById('pendingcase');
        var detailsSection = document.getElementById('detailsSection');

        if (pendingCaseSelect.value === 'yes') {
            detailsSection.style.display = 'block';
        } else {
            detailsSection.style.display = 'none';
        }
    }

    window.onload = function() {
        toggleDetailsSection();
    };
</script>


<?php include "includes/footer.php"; ?>