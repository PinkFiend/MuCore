<?
//links
define('link_home','Home');
define('link_announcements','Anuncios');
define('link_new_account','Registrarse');
define('link_log_out','Cerrar Sesión');
define('link_lost_password','¿Perdiste tu ID o Contraseña?');
define('link_sign_up','¡Registrate!');
define('link_read_more','Leer Más');
define('link_permanent_banned_characters','Ver Personajes Baneados Permanentemente');
define('link_banned_characters','Ver Personajes Baneados');
define('link_check_available','¿Disponible?');
define('link_check_status','Checkear Estado');
define('link_location','Ubicación');
define('link_account_settings','Opciones de Cuenta');

//buttons
define('button_log_in','Iniciar Sesión');
define('button_proceed_checkout','Proceed Checkout');
define('button_post_message','Enviar Mensaje');
define('button_reset_character','Resetear Personaje');
define('button_add_points','Agregar Puntos');
define('button_clear_pk','Quitar el estado PK');
define('button_unstuck_character','Destrabar Personaje');
define('button_clear_inventory','Vaciar Inventario');
define('button_clear_skills','Borrar skills');
define('button_purchase_credits','Comprar créditos');
define('button_grand_reset_character','Grand Reset Character');

/*--------------------------------------*\
| This are the links from menu           |
| and user cp.                           |
|                                        |
| $menu_links_title - Pages titles       |
| from admincp (dont translate them)     |
|                                        |
| $menu_links_translated - Pages titles  |
| translated (translate this)            |
\*--------------------------------------*/

//dont translate here
$menu_links_title      = array('News','Announcements','Downloads','Donate for Credits','Banned Characters','Chat','Rankings','Register','Terms of Service','Contact Us','Forum','Reset Character','Add Points','Clear PK Status','Unstuck Character','Clear Inventory','Clear Skills','MU Coins','Grand Reset Character','Account Settings','User CP',);

//translate here
$menu_links_translated = array('Novedades','Anuncios','Descargas','Donar','Personajes Baneados','Chat','Rankings','Registrarse','Condiciones del Servicio','Contacto','Foro','Resetear Personaje','Agregar Puntos','Quitar estado PK','Destrabar Personaje','Vaciar Inventario','Borrar Skills','MU Coins','Grand Reset Character','Opciones de Cuenta','Panel de Usuario',);



/*-----------------------------------------*\
| This are the modues from pages            |
| and user cp.                              |
|                                           |
| $modules_text_tile - Modules titles       |
| from admincp (dont translate them)        |
|                                           |
| $modules_text_translate - Modules titles  |
| translated (translate this)               |
\*-----------------------------------------*/
//dont translate here
$modules_text_tile      = array('News','Downloads','Chat','Announcements','Rankings','Register','Terms of Service','Log In','Lost Password','User CP','Log Out','Contact Us','Banned Characters','Donate with PayPal','Latest RSS','Reset Character','Add Points','Clear PK Status','Unstuck Character','Clear Inventory','Clear Skills','MU Coins','Grand Reset Character','Account Settings',);

//translate here
$modules_text_translate = array('Novedades','Descargas','Chat','Anuncios','Rankings','Registrarse','Condiciones del Servicio','Log In','Recuperar Contraseña','Panel de Usuario','Log Out','Contacto','Personajes Baneados','Donar con PayPal','Ultimos RSS','Resetear Personaje','Agregar Puntos','Quitar estado PK','Destrabar Personaje','Vaciar Inventario','Borrar Skills','MU Coins','Grand Reset Character','Opciones de Cuenta',);



//texts
define('text_not_loggd_in','No has iniciado sesión');
define('text_log_in','Iniciar Sesión');
define('text_start_play_now','Jugar Ahora');
define('text_member_area','Area de Miembros');
define('text_menu','Menu');
define('text_announcement','Anuncio');
define('text_posted_on','Enviado el');
define('text_untill','hasta');
define('text_notice','Aviso');
define('text_ban_expire','Las cuentas Baneadas <b>no son mostradas</b>. Luego de la fecha especificada, la cuenta sera desbaneada automáticamente.');
define('text_banned_on','Baneado el');
define('text_expire_date','Fecha de expiración');
define('text_rason','Razón');
define('text_sorry_no_ban','Lo siento, no se han encontrado Personajes Baneados.');
define('text_user_id','ID de Usuario');
define('text_password','Contraseña');
define('text_cnf_password','Confirmar Contraseña');
define('text_personal_id','ID Personal');
define('text_email_address','Correo Electrónico');
define('text_country','País');
define('text_gender','Genero');
define('text_male','Masculino');
define('text_female','Femenino');
define('text_select','Seleccionar');
define('text_wrong_login_ban','<b>Datos de Cuenta Inválidos.</b><br><br> Has alcanzado el límite de intentos de sesión. <b>Deberás de esperar 15 minutos para volver a intentar.</b> <br>Recuerda que se distinguen mayúsculas y minúsculas para la ID de Usuario y Contraseña.');
define('text_wrong_login','<b>Has ingresado una ID de Usuario o Contraseña no válida</b> <br><br>Al iniciar sesión se distinguen mayúsculas y minúsculas.<br /><br /><b>Has usado {attempts_count} de los 5 intentos de sesión.</b> En caso de que hayas usado los 5 intentos de sesión y no hayas ingresado los datos correctos, serás bloqueado por 15 minutos.');
define('text_sorry_no_donations','Lo siento, aun no se puede donar.');
define('text_sorry_feature_disabled','Lo siento, esta opción se encuentra inaccesible temporalmente.');
define('text_issued_credits','Creditos Agregados');
define('text_your_donate_info','Info de tu Donación');
define('text_donate_amount','Cantidad Donada');
define('text_checkout_error','No ha sido posible verificar la donación, razón: error del sistema, contacta a un Administrador.');
define('text_chat_error1','No se ha podido enviar el mensaje, razón: algunos casilleros han sido dejados en blanco.');
define('text_chat_error2','No se ha podido enviar el mensaje, razón: el nombre debe de contener al menos 4 caracteres.');
define('text_chat_error3','No se ha podido enviar el mensaje, razón: el nombre ha sido reservado.');
define('text_chat_name','Nombre');
define('text_chat_req1','4-10 caracteres.');
define('text_chat_message','Mensaje');
define('text_chat_req2','300 caracteres.');
define('text_register_error1','Has ingresado una ID de Usuario inválida (4-10 caracteres, letras y números unicamente)');
define('text_register_error2','Has ingresado una Contraseña inválida (6-12 caracteres, letras y números unicamente)');
define('text_register_error3','Las contraseñas no Coinciden');
define('text_register_error4','Has ingresado una ID Personal inválida ({pers_id_length} digitos, solo números)');
define('text_register_error5','Has ingresado un correo electrónico inválido (ej. alguien@ejemplo.com)');
define('text_register_error6','Código de País inválido');
define('text_register_error7','Código de Género inválido');
define('text_register_error8','Pregunta secreta inválida');
define('text_register_error9','Has ingresado una respuesta inválida para tu pregunta secreta (4-20 caracteres, letras y números unicamente)');
define('text_register_error10','¿Eres realmente un humano? ¡Ingresa el código de verificación correctamente!');
define('text_register_error11','La ID de Usuario ingresada está en uso.');
define('text_register_error12','El correo electrónico ingresado está en uso.');
define('text_register_success1','Gracias, {userid}. ¡Tu registro ha sido completado!');
define('text_register_success2','Gracias, {userid}. ¡Tu registro ha sido completado! <br>Se ha enviado un correo a '.$email.' con los detalles para activar tu cuenta.<br><br>Recibirás un correo en tu Bandeja de Entrada o en tu Casilla de Spam. Debes de hacer click en el link del correo para empezar a Jugar.');
define('text_register_error13','No ha sido posible procesar tu solicitud, razón: error de sistema, contacta a un Administrador.');
define('text_register_error14','No ha sido posible procesar tu solicitud, razón: no ha sido posible conectarse al servidor SMTP, contacta a un Administrador.');
define('text_register_error15','No ha sido posible completar el registro, razón: error de sistema, contacta a un Administrador.');
define('text_register_error16','No ha sido posible activar la cuenta, razón: error de sistema, contacta a un Administrador.');
define('text_register_error17','Tu cuenta ha sido activada anteriormente!.');
define('text_register_success3','Gracias, {userid}. ¡Tu registro ha sido completado!');
define('text_register_error18','No ha sido posible activar la cuenta, razón: error de sistema, contacta a un Administrador.');
define('text_register_complete_form','Completar el Formulario');
define('text_register_activate_account','Activar Cuenta');
define('text_register_t1','Ingresa la información de ingreso deseada');
define('text_register_req1','4-10 caracteres, letras y números unicamente');
define('text_register_req2','6-12 caracteres, letras y números unicamente');
define('text_register_req3','Se distinguen mayúsculas y minúsculas');
define('text_register_t2','Ingresa un numero de ID Personal (se usará en el juego)');
define('text_register_req4','12 digitos, números unicamente');
define('text_register_t3','Ingresa un correo electrónico válido');
define('text_register_req5','ej: alguien@ejemplo.com');
define('text_register_t4','Información Adicional');
define('text_register_t5','Para ayudar a identificar tu cuenta, por favor selecciona una pregunta secreta de la lista y respondela');
define('text_register_secret_question','Pregunta Secreta');
define('text_register_answer_question','Respuesta Secreta');
define('text_register_req6','4-20 caracters, letras y números unicamente');
define('text_register_t6','Verificación de Imágen');
define('text_register_type_code','Ingresa el código aquí');
define('text_register_read_terms1','He leído y acepto las');
define('text_register_read_terms2','Condiciones de Servicio');
define('text_rankings_update_date','La Próxima Actualización de Rankings Programada es el {date}');
define('text_contact_us_invalid_name','Has ingresado un nombre inválido.');
define('text_contact_us_invalid_email','Has ingresado un correo electrónico inválido (ej. alguien@ejemplo.com).');
define('text_contact_us_invalid_subject','Has ingresado un Asunto inválido.');
define('text_contact_us_err1','¿Eres realmente un humano? ¡Ingresa el código de verificación correctamente!');
define('text_contact_us_msg1','Mensaje enviado exitosamente!');
define('text_contact_us_err2','No ha sido posible procesar tu solicitud, razón: error de sistema, contacta a un Administrador.');
define('text_contact_us_err3','No ha sido posible procesar tu solicitud, razón: no ha sido posible conectarse al servidor SMTP, contacta a un Administrador.');
define('text_contact_us_t1','Tus detalles de Contacto');
define('text_contact_us_t2','Nombre');
define('text_contact_us_t3','Correo Electrónico');
define('text_contact_us_t4','ej: alguien@ejemplo.com');
define('text_contact_us_t5','Asunto');
define('text_contact_us_t6','Mensaje');
define('text_contact_us_t7','{msg_length} Caracteres');
define('text_contact_us_t8','Verificación de Imágen');
define('text_contact_us_t9','Ingresa el código aquí');
define('text_contact_us_t10','Contáctanos al email {mail}');
define('text_lostpwd_t1','Has ingresado una ID de Usuario inválida (4-12 caracteres, letras y números únicamente)');
define('text_lostpwd_t2','¿Eres realmente un humano? ¡Ingresa el código de verificación correctamente!');
define('text_lostpwd_t3','No se ha podido encontrar la ID de Usuario.');
define('text_lostpwd_t4','Has ingresado una respuesta inválida para tu pregunta Secreta (4-20 caracteres, letras y números únicamente)');
define('text_lostpwd_t5','La respuesta ingresada no es correcta.');
define('text_lostpwd_t6','No se ha podido cambiar la contraseña, razón: error de sistema, por favor contacta a un administrador.');
define('text_lostpwd_t7','Completar Formulario');
define('text_lostpwd_t8','Respuesta a la Pregunta Secreta');
define('text_lostpwd_t9','Obtener Contraseña');
define('text_lostpwd_t10','Correcto!!');
define('text_lostpwd_t11','Tu nueva Contraseña es');
define('text_lostpwd_t12','Para ver la contraseña, seleccionar con el mouse en la caja.');
define('text_lostpwd_t13','Por favor responde tu Pregunta Secreta');
define('text_lostpwd_t14','Pregunta Secreta');
define('text_lostpwd_t15','Respuesta');
define('text_lostpwd_t16','4-20 caracteres, letras y números únicamente');
define('text_lostpwd_t17','Verificación de Imágen');
define('text_lostpwd_t18','Ingresa el código aquí');
define('text_lostpwd_t19','Por favor ingresa tu ID de Usuario');
define('text_lostpwd_t20','ID de Usuario');
define('text_lostpwd_t21','4-12 caracteres, letras y números únicamente');
define('text_lostpwd_t22','No se pudo encontrar el Correo Electrónico.');
define('text_lostpwd_t23','Tu ID de Usuario y los detalles de como resetear tu contraseña han sido enviados a tu correo electrónico.');
define('text_lostpwd_t24','No ha sido posible procesar tu solicitud, razón: error de sistema, contacta a un Administrador.');
define('text_lostpwd_t25','No ha sido posible procesar tu solicitud, razón: no ha sido posible conectarse al servidor SMTP, contacta a un Administrador.');
define('text_lostpwd_t26','Se ha reseteado y enviado tu contraseña a tu correo electrónico. Revisa tu correo electronico para conocer tu nueva contraseña.');
define('text_lostpwd_t27','Por favor ingresa un correo electrónico válido');
define('text_lostpwd_t28','Correo Electrónico');
define('text_lostpwd_t29','ej: alguien@ejemplo.com');

define('text_resetcharacter_t1','La Cuenta está conectada en el juego, por favor cierra el juego.');
define('text_resetcharacter_t2','No se puede hacer el reset, razón: Te faltan {levels} niveles.');
define('text_resetcharacter_t3','No se puede hacer el reset, razón: Te falta {zen} zen.');
define('text_resetcharacter_t4','No se puede hacer el reset, razón: límite de resets excedido : {resets_limit}');
define('text_resetcharacter_t5','Se ha reseteado el Personaje exitosamente.');
define('text_resetcharacter_t6','No se puede hacer el reset, razón: error de sistema, contacta a un Administrador.');
define('text_resetcharacter_t7','Requerimientos para Resetear un Personaje');
define('text_resetcharacter_t8','Formula de Reset');
define('text_resetcharacter_t9','Puntos de Bonificación');
define('text_resetcharacter_t10','Límite de Resets');
define('text_resetcharacter_t11','Zen');
define('text_resetcharacter_t12','Nivel');
define('text_resetcharacter_t13','Borrar Skills');
define('text_resetcharacter_t14','Vaciar Inventario');
define('text_resetcharacter_t15','Resetear Stats');
define('text_resetcharacter_t16','faltan {levels} niveles y {zen} zen');
define('text_resetcharacter_t17','faltan {levels} niveles');
define('text_resetcharacter_t18','falta {zen} zen');
define('text_resetcharacter_t19','límite de resets excedido : {resets_limit}');

define('text_points_t1','La Cuenta está conectada en el juego, por favor cierra el juego.');
define('text_points_t2','No se pueden agregar puntos, razón: no tienes suficientes puntos.');
define('text_points_t3','No se pueden agregar puntos, razón: límite de Strength excedido (límite de strength: {str_limit}).');
define('text_points_t4','No se pueden agregar puntos, razón: límite de Agility excedido (límite de agility: {agi_limit}).');
define('text_points_t5','No se pueden agregar puntos, razón: límite de Vitality excedido (límite de vitality: {vit_limit}).');
define('text_points_t6','No se pueden agregar puntos, razón: límite de Energy excedido (límite de energy: {eng_limit}).');
define('text_points_t7','No se pueden agregar puntos, razón: límite de Command excedido (límite de command: {cmd_limit}).');
define('text_points_t8','Puntos agregados Exitosamente.');
define('text_points_t9','No se pueden agregar puntos, razón: error de sistema, contacta a un Administrador');
define('text_points_t10','no se han encontrado puntos de levelup.');
define('text_points_t11','Límite alcanzado.');
define('text_points_t12','Límites de Stats');

define('text_pk_t1','La Cuenta está conectada en el juego, por favor cierra el juego.');
define('text_pk_t2','No se puede quitar el estado de PK, razón: no has matado a nadie, debes matar más para usar esta función.');
define('text_pk_t3','No se puede quitar el estado de PK, razón: Te falta {zen} zen.');
define('text_pk_t4','Estado de PK quitado exitosamente.');
define('text_pk_t5','No se puede quitar el estado de PK, razón: error de sistema, contacta a un Administrador');
define('text_pk_t6','Requerimientos para Borrar el Estado de PK');
define('text_pk_t7','{zen} / estado (ej: si tienes nivel de asesino 2, necesitas pagar {total_zen}');
define('text_pk_t8','Eres un cobarde, ¿por qué no intentas matar a alguien?.');
define('text_pk_t9','WTF! Mata a algunos asesinos para incrementar tu nivel de héroe.');
define('text_pk_t10','Hurra! Erradica a esos asesinos! Eres un héroe.');
define('text_pk_t11','te falta {zen} zen');

define('text_ustuckcharacter_t1','La Cuenta está conectada en el juego, por favor cierra el juego.');
define('text_ustuckcharacter_t2','Personaje destrabado exitosamente.');
define('text_ustuckcharacter_t3','No se puede destrabar, razón: error de sistema, contacta a un Administrador');
define('text_ustuckcharacter_t4','Luego de utilizar la función de destrabar, el personaje será teletransportado a <b>{map}</b>, coords: <b>{coord_x}</b> con <b>{coord_y}</b>');
define('text_ustuckcharacter_t5','Ubicación');
define('text_ustuckcharacter_t6','Información del Personaje a Destrabar');

define('text_clearinventory_t1','La Cuenta está conectada en el juego, por favor cierra el juego.');
define('text_clearinventory_t2','Inventario del Personaje vaciado exitosamente.');
define('text_clearinventory_t3','No se puede vaciar el inventario, razón: error de sistema, contacta a un Administrador');
define('text_clearinventory_t4','Información de Vaciar Inventario');
define('text_clearinventory_t5','Luego de utilizar la función de Vaciar Inventario, <b>el inventario del personaje será reseteado</b>.');
define('text_clearinventory_t6','¿Estás seguro que deseas vaciar el inventario?');

define('text_clearskills_t1','La Cuenta está conectada en el juego, por favor cierra el juego.');
define('text_clearskills_t2','Se han borrado los skills del personaje exitosamente.');
define('text_clearskills_t3','No se ha podido borrar los skills, razón: error de sistema, contacta a un Administrador');
define('text_clearskills_t4','Información de Borrar Skills');
define('text_clearskills_t5','Luego de utilizar la función de Borrar Skills, <b>los skills del Personaje serán borrados</b>.');
define('text_clearskills_t6','¿Estás seguro que deseas borrar los skills?');

define('text_mucoins_t1','Se ha creado exitosamente la cuenta de créditos.');
define('text_mucoins_t2','No se ha podido crear la cuenta de créditos, razón: error de sistema, contacta a un Administrador');
define('text_mucoins_t3','Información de Créditos');
define('text_mucoins_t4','Créditos');
define('text_mucoins_t5','Tus Transacciones de PayPal');
define('text_mucoins_t6','Transaction ID');
define('text_mucoins_t7','Cantidad');
define('text_mucoins_t8','Créditos Generados');
define('text_mucoins_t9','Fecha del a Orden');
define('text_mucoins_t10','Estado del Pago');
define('text_mucoins_t11','No se han encontrado Transacciones.');

define('text_grandreset_t1','La Cuenta está conectada en el juego, por favor cierra el juego.');
define('text_grandreset_t2','No se ha podido realizar el reset, razón: Te faltan {resets} resets.');
define('text_grandreset_t3','No se ha podido realizar el reset, razón: Te faltan {level} niveles.');
define('text_grandreset_t4','No se ha podido realizar el reset, razón: Te falta {zen} zen.');
define('text_grandreset_t5','Se ha realizado el grand reset a tu personaje exitosamente.');
define('text_grandreset_t6','No se ha podido realizar el grand reset, razón: error de sistema, contacta a un Administrador.');
define('text_grandreset_t7','Requerimientos para Resetear el Personaje');
define('text_grandreset_t8','Fórmula del Reset');
define('text_grandreset_t9','Bono de Créditos');
define('text_grandreset_t10','Bono de puntos de levelup');
define('text_grandreset_t11','Borrar Skills');
define('text_grandreset_t12','Vaciar Inventario');
define('text_grandreset_t13','Resetear Stats');
define('text_grandreset_t14','te faltan {resets} resets, {level} niveles y {zen} zen');
define('text_grandreset_t15','te faltan {resets} resets');
define('text_grandreset_t16','te faltan {level} niveles');
define('text_grandreset_t17','te falta {zen} zen');
define('text_grandreset_t18','¿Estás Seguro?');

define('text_accountsettings_t1','La contraseña actual ingresada es inválida (6-12 caracteres, letras y números únicamente)');
define('text_accountsettings_t2','La contraseña ingresada es inválida (6-12 caracteres, letras y números únicamente)');
define('text_accountsettings_t3','Las contraseñas no coinciden');
define('text_accountsettings_t4','¿Eres realmente un humano? ¡Ingresa el código de verificación correctamente!');
define('text_accountsettings_t5','La contraseña actual es incorrecta');
define('text_accountsettings_t6','No se ha podido verificar la contraseña, razón: error de sistema, contacta a un Administrador.');
define('text_accountsettings_t7','Completar Formulario');
define('text_accountsettings_t8','Enviando Correo de Confirmación');
define('text_accountsettings_t9','Confirmar cambio de Contraseña');
define('text_accountsettings_t10','Camos de Contraseña');
define('text_accountsettings_t11','Contraseña Actual');
define('text_accountsettings_t12','6-12 caracteres, letras/números únicamente');
define('text_accountsettings_t13','Nueva Contraseña');
define('text_accountsettings_t14','Confirmar Nueva Contraseña');
define('text_accountsettings_t16','Se distinguen mayúsculas y minúsculas');
define('text_accountsettings_t17','Verificación de Imágen');
define('text_accountsettings_t18','Ingresa el código aquí');
define('text_accountsettings_t19','Se te ha enviado un correo de verificación del cambio de Contraseña a tu correo electrónico.');
define('text_accountsettings_t20','No ha sido posible procesar tu solicitud, razón: error de sistema, contacta a un Administrador.');
define('text_accountsettings_t21','No ha sido posible procesar tu solicitud, razón: no ha sido posible conectarse al servidor SMTP, contacta a un Administrador.');
define('text_accountsettings_t22','No ha sido posible cambiar tu Contraseña, razón: El link ha expirado.');
define('text_accountsettings_t23','Se ha cambiado la Contraseña exitosamente, vuelve a iniciar sesión.');
define('text_accountsettings_t24','No se ha podido cambiar la Contraseña, razón: serror de sistema, contacta a un Administrador.');
define('text_accountsettings_t25','No se ha podido verificar la Contraseña, razón: serror de sistema, contacta a un Administrador.');

//1.0.4
define('text_resetcharacter_t_levelupbonusinfo','({reset_points} * numero de resets) - El producto de los puntos por reset {reset_points} con el número de resets que tienes.');

define('text_grandresetcharacter_t_levelupbonusinfo','({grandreset_credits} * número de grand resets) - El producto del bono de créditos {grandreset_credits} y el número de grand resets que tienes.');

//1.0.5
define('mail_register_t1','Querido {user_id},<br><br>Gracias por registrarte en {website_title}. Antes de que podamos activar tu cuenta debes completar un utlimo paso en tu registro.<br><br>Ten en cuenta - debes de completar este paso para ser un miembro registrado. Únicamente deberás de visitar el siguiente link una vez para activar tu cuenta.<br><br>Para completar tu registro, por favor visita esta página:<br><a href="{activation_url}">{activation_url}</a><br><br><br>Muchas Gracias,<br>{website_title}.');

define('mail_lostpassword_t1','Querido {user_id},<br><br>Has solicitado resetear tu contraseña en {website_title} porque olvidaste tu contraseña. Si no has solicitado esto, por favor ignora este correo. Expirará en 24 horas.<br><br>Para resetear tu contraseña, por favor visita la siquiente página:<br><a href="{reset_password_url}">{reset_password_url}</a><br><br>Cuando visites esa página, tu contraseña será reseteada y se te enviará un correo con tu nueva contraseña.<br><br>Tu ID de Usuario es: {user_id}<br><br><br>Muchas Gracias,<br>{website_title}.');

define('mail_lostpassword_t2','Querido {user_id},<br><br>Tal como lo has solicitado, tu contraseña ha sido reseteada. Tus nuevos datos son:<br><br>ID de Usuario: {request_username}<br>Contraseña: {new_password}<br><br>Para cambiar tu contraseña, por favor visita la siguiente página:<br><a href="{change_password_url}">{change_password_url}</a><br><br>Muchas Gracias,<br>{website_title}.');

define('mail_changepassword_t1','Querido {user_id},<br><br>Has solicitado cambiar tu contraseña en {website_title}. Si no has solicitado esto, por favor ignora este correo. Expirará en 24 horas.<br><br>Para cambiar tu contraseña, por favor visita la siguiente página:<br><a href="{change_password_url}">{change_password_url}</a><br><br>>Cuando visites esa página, tu contraseña será cambiada.<br><br>Tu ID de Usuario es: {user_id}<br>Tu nueva Cotnraseña es: {new_password}<br><br><br>Muchas Gracias,<br>{website_title}.');

#Reset Stats
define('button_reset_stats','Reset Stats');
define('text_resetstats_t1','Account is connected on game, please logout.');
define('text_resetstats_t2','Character\'s stats successfully reseted.');
define('text_resetstats_t3','Unable to reset stats, reason: system error, please contact administrator.');
define('text_resetstats_t4','Reset Stats Info');
define('text_resetstats_t5','After using reset stats function, <b>character\'s stats will be reseted</b>.');
define('text_resetstats_t6','Are you sure you want to reset stats?');
define('text_resetstats_t7','lacking {resets} resets');
define('text_resetstats_t8','Reset Stats Requirements');


#Castle Siege
define('cs_end','Siege Ended');
define('cs_start','Siege Started');
define('cs_no_owner','no owner');
define('cs_info','Siege Info');
define('cs_status','Status');
define('cs_guild_owner','Castle Guild Owner');
define('cs_money','Money');
define('cs_chaos_tax','Chaos Tax');
define('cs_store_tax','Store Tax');
define('cs_hunt_tax','Hunt Zone Tax');
define('cs_registered_guilds','Registered Guilds');
define('cs_guild_master','Guild Master');
define('cs_score','Score');
define('cs_no_guilds','There are no registered guilds.');


?>