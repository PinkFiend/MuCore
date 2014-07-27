<?
/**
* @+===========================================================================+
* @¦ MuCore 1.0.8 English.       					       ¦
* @¦ Credits: Isumeru & MaryJo  					       ¦
* @¦ +=======================================================================+ ¦
* @¦ ¦  "He who Copy/Pastes Shall Inherit My Mistakes But Not My Knowledge"  ¦ ¦
* @¦ +=======================================================================+ ¦
* @¦ Official Site:   http://bizarre-networks.net                              ¦
* @+===========================================================================+
* @¦ Our Allied Site: http://chileplanet.org                                   ¦
* @+===========================================================================+
*/
if (!isset($_GET[USER_GET_PAGE])) {
    $uss_cp_mod = HOME_CMS_USER;
} else {
    $uss_cp_mod = xss_clean(safe_input($_GET[USER_GET_PAGE], "_"));
}

$user_id = safe_input($user_auth->username, "_");



$get_f_mod = file('engine/cms_data/mods_uss.cms');
foreach ($get_f_mod as $uss_mod) {
    $uss_mod = explode("¦", $uss_mod);
    if ($uss_mod[3] == $uss_cp_mod) {
        if ($uss_mod[6] == '1') {
            $found_module_user_mw = '1';
            if (CMS_NAVBAR != '1') {
                $usercp_module_title = str_replace($modules_text_tile, $modules_text_translate, $uss_mod[2]);
            }
            echo '<div class="usercp_module">&not; ' . $usercp_module_title . '</div>';
            if ($uss_mod[5] == '1') {
                if (is_file('pages_modules/user_cp/' . $uss_mod[4] . '')) {
                    include('pages_modules/user_cp/' . $uss_mod[4] . '');
                } else {
                    echo 'Unable to load module file, reason: not found.';
                }
                
            } elseif ($uss_mod['5'] == '0') {
                if (is_file('engine/cms_data/cms_co/' . $uss_mod[1] . '_cms.cms')) {
                    include('engine/cms_data/cms_co/' . $uss_mod[1] . '_cms.cms');
                } else {
                    echo 'Unable to load module content, reason: not found.';
                }
            }
            break;
        }
    }
}
if ($found_module_user_mw != '1') {
    header('Location: ' . ROOT_INDEX . '');
}
/**
* @+===========================================================================+
* @¦ MuCore 1.0.8 English.       					       ¦
* @¦ Credits: Isumeru & MaryJo  					       ¦
* @¦ +=======================================================================+ ¦
* @¦ ¦  "He who Copy/Pastes Shall Inherit My Mistakes But Not My Knowledge"  ¦ ¦
* @¦ +=======================================================================+ ¦
* @¦ Official Site:   http://bizarre-networks.net                              ¦
* @+===========================================================================+
* @¦ Our Allied Site: http://chileplanet.org                                   ¦
* @+===========================================================================+
*/
?> 