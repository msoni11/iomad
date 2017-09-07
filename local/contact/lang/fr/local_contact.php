<?php
// This file is part of the Contact Form plugin for Moodle - http://moodle.org/
//
// Contact Form is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Contact Form is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Contact Form.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This plugin for Moodle is used to send emails through a web form.
 *
 * @package    local_contact
 * @copyright  2016-2017 TNG Consulting Inc. - www.tngconsulting.ca
 * @author     Michael Milette
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Formulaire de contact';
$string['globalhelp'] = 'Formulaire de contact est un plugiciel pour Moodle qui permet à votre site traiter les informations soumis par le biais de formulaires Web HTML à l\'adresse courriel de soutien du site.';
$string['configure'] = 'Configurer ce plugiciel';

$string['field-name'] = 'nom';
$string['field-email'] = 'courriel';
$string['field-subject'] = 'objet';
$string['field-message'] = 'message';

$string['confirmationmessage'] = 'Merci de nous contacter. Si nécessaire, nous serons en contact avec vous très bientôt.';
$string['confirmationsent'] = 'Un courriel a été envoyé à votre adresse à {$a}.';
$string['forbidden'] = 'Interdit';
$string['errorsendingtitle'] = 'Envoi de courriel échoué';
$string['errorsending'] = 'Une erreur est survenue lors de l\'envoi du message. Veuillez essayez de nouveau plus tard.';

$string['defaultsubject'] = 'Nouveau message';
$string['extrainfo'] = '<hr>
<p><strong>Informations supplémentaires de l\'utilisateur</strong></p>
<ul>
    <li><strong>Utilisateur du site&nbsp;:</strong> [userstatus]</li>
    <li><strong>Langue préférée&nbsp;:</strong> [lang]</li>
    <li><strong>De l\'adresse IP&nbsp;:</strong> [userip]</li>
    <li><strong>Navigateur Web&nbsp;:</strong> [http_user_agent]</li>
    <li><strong>Formulaire Web&nbsp;:</strong> <a href="[http_referer]">[http_referer]</a></li>
</ul>
';
$string['confirmationemail'] = '
<p>[fromname],</p>
<p>Merci de nous avoid contacter. Si nécessaire, nous serons en contact avec vous très bientôt.</p>
<p>Cordialement,</p>
<p>[supportname]<br>
[sitefullname]<br>
<a href="[siteurl]">[siteurl]</a></p>
';
$string['lockedout'] = 'VERROUILLÉ';
$string['notconfirmed'] = 'PAS CONFIRMÉ';
