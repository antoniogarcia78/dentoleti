<?php
/*
 *	This file is part of Dentoleti.
 *
 *  Dentoleti is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Dentoleti is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with Dentoleti. Read COPYING.txt file for more information.
 *  If it is not present, see <http://www.gnu.org/licenses/>. 
 *
 *  You should find all the information about Dentoleti in http://dentoleti.es
 *
 *	Author Information:
 *		@Author: Luis González Rodríguez
 *		@Email: desarrollo@luismagonzalez.es
 *		@Github: https://github.com/luismagr
 *  	@Author web: http://luismagonzalez.es
 *
 *  File Information:
 *  	@Date:   2014-04-12 09:21:05
 *  	@Last Modified by:   Luis González Rodríguez
 *  	@Last Modified time: 2014-04-12 10:29:19
 * 
 */
namespace Dentoleti\GeneralBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dentoleti\GeneralBundle\Entity\Country;

/**
 * Carga de países que manejará la aplicación
 */
class Countries extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 3;
	}

	public function load(ObjectManager $manager){
		$countries = array(
			array('name' => 'Irlanda', 'id' => '109'),
			array('name' => 'Mónaco', 'id' => '149'),
			array('name' => 'Azerbaiyán', 'id' => '018'),
			array('name' => 'Malasia', 'id' => '133'),
			array('name' => 'Finlandia', 'id' => '080'),
			array('name' => 'Serbia y Montenegro', 'id' => '197'),
			array('name' => 'Aruba', 'id' => '015'),
			array('name' => 'Guinea Ecuatorial', 'id' => '097'),
			array('name' => 'Libia', 'id' => '126'),
			array('name' => 'Islas Malvinas', 'id' => '138'),
			array('name' => 'Nueva Caledonia', 'id' => '163'),
			array('name' => 'Argentina', 'id' => '013'),
			array('name' => 'Bolivia', 'id' => '029'),
			array('name' => 'Palestina', 'id' => '169'),
			array('name' => 'Burkina Faso', 'id' => '036'),
			array('name' => 'San Cristóbal y Nevis', 'id' => '189'),
			array('name' => 'Ghana', 'id' => '087'),
			array('name' => 'Vietnam', 'id' => '233'),
			array('name' => 'Mauricio', 'id' => '143'),
			array('name' => 'Turkmenistán', 'id' => '224'),
			array('name' => 'Micronesia', 'id' => '147'),
			array('name' => 'Panamá', 'id' => '170'),
			array('name' => 'Etiopía', 'id' => '077'),
			array('name' => 'Uzbekistán', 'id' => '230'),
			array('name' => 'Kuwait', 'id' => '120'),
			array('name' => 'Pakistán', 'id' => '167'),
			array('name' => 'Camerún', 'id' => '041'),
			array('name' => 'Antártida', 'id' => '008'),
			array('name' => 'Dominica', 'id' => '064'),
			array('name' => 'San Pedro y Miquelón', 'id' => '191'),
			array('name' => 'Liberia', 'id' => '125'),
			array('name' => 'Islas Cook', 'id' => '056'),
			array('name' => 'Islas Gland', 'id' => '002'),
			array('name' => 'Islas Turcas y Caicos', 'id' => '223'),
			array('name' => 'Trinidad y Tobago', 'id' => '221'),
			array('name' => 'Jamaica', 'id' => '113'),
			array('name' => 'Canadá', 'id' => '042'),
			array('name' => 'Cabo Verde', 'id' => '038'),
			array('name' => 'Comoras', 'id' => '053'),
			array('name' => 'Estados Unidos', 'id' => '075'),
			array('name' => 'Santa Lucía', 'id' => '194'),
			array('name' => 'Yemen', 'id' => '237'),
			array('name' => 'Santo Tomé y Príncipe', 'id' => '195'),
			array('name' => 'Reunión', 'id' => '181'),
			array('name' => 'Andorra', 'id' => '005'),
			array('name' => 'Albania', 'id' => '003'),
			array('name' => 'Samoa', 'id' => '187'),
			array('name' => 'Santa Helena', 'id' => '193'),
			array('name' => 'Siria', 'id' => '201'),
			array('name' => 'Guam', 'id' => '093'),
			array('name' => 'Uruguay', 'id' => '229'),
			array('name' => 'India', 'id' => '105'),
			array('name' => 'Bosnia y Herzegovina', 'id' => '030'),
			array('name' => 'Emiratos Árabes Unidos', 'id' => '069'),
			array('name' => 'Lesotho', 'id' => '122'),
			array('name' => 'Territorios Australes Franceses', 'id' => '216'),
			array('name' => 'República Centroafricana', 'id' => '043'),
			array('name' => 'Fiyi', 'id' => '081'),
			array('name' => 'Sudán', 'id' => '206'),
			array('name' => 'República Dominicana', 'id' => '065'),
			array('name' => 'Macao', 'id' => '130'),
			array('name' => 'Gibraltar', 'id' => '088'),
			array('name' => 'Arabia Saudí', 'id' => '011'),
			array('name' => 'Islas Marianas del Norte', 'id' => '139'),
			array('name' => 'Bangladesh', 'id' => '021'),
			array('name' => 'Tailandia', 'id' => '211'),
			array('name' => 'Mauritania', 'id' => '144'),
			array('name' => 'Corea del Sur', 'id' => '058'),
			array('name' => 'San Marino', 'id' => '190'),
			array('name' => 'Letonia', 'id' => '123'),
			array('name' => 'Mongolia', 'id' => '150'),
			array('name' => 'Singapur', 'id' => '200'),
			array('name' => 'Italia', 'id' => '112'),
			array('name' => 'Somalia', 'id' => '202'),
			array('name' => 'Grecia', 'id' => '090'),
			array('name' => 'Nauru', 'id' => '155'),
			array('name' => 'República Checa', 'id' => '045'),
			array('name' => 'Afganistán', 'id' => '001'),
			array('name' => 'Malawi', 'id' => '134'),
			array('name' => 'Benin', 'id' => '026'),
			array('name' => 'Gabón', 'id' => '083'),
			array('name' => 'Cuba', 'id' => '062'),
			array('name' => 'Turquía', 'id' => '225'),
			array('name' => 'Francia', 'id' => '082'),
			array('name' => 'Antigua y Barbuda', 'id' => '009'),
			array('name' => 'Isla Bouvet', 'id' => '032'),
			array('name' => 'Togo', 'id' => '218'),
			array('name' => 'Islas Pitcairn', 'id' => '174'),
			array('name' => 'China', 'id' => '047'),
			array('name' => 'Armenia', 'id' => '014'),
			array('name' => 'Islas ultramarinas de Estados Unidos', 'id' => '074'),
			array('name' => 'Marruecos', 'id' => '140'),
			array('name' => 'Filipinas', 'id' => '079'),
			array('name' => 'Eslovaquia', 'id' => '071'),
			array('name' => 'Indonesia', 'id' => '106'),
			array('name' => 'Isla Norfolk', 'id' => '161'),
			array('name' => 'Bermudas', 'id' => '027'),
			array('name' => 'Chipre', 'id' => '048'),
			array('name' => 'Rusia', 'id' => '184'),
			array('name' => 'Wallis y Futuna', 'id' => '236'),
			array('name' => 'ARY Macedonia', 'id' => '131'),
			array('name' => 'Guayana Francesa', 'id' => '095'),
			array('name' => 'Argelia', 'id' => '012'),
			array('name' => 'Hungría', 'id' => '104'),
			array('name' => 'Camboya', 'id' => '040'),
			array('name' => 'Sudáfrica', 'id' => '205'),
			array('name' => 'Bulgaria', 'id' => '035'),
			array('name' => 'Países Bajos', 'id' => '166'),
			array('name' => 'Angola', 'id' => '006'),
			array('name' => 'Chad', 'id' => '044'),
			array('name' => 'Tokelau', 'id' => '219'),
			array('name' => 'Suazilandia', 'id' => '204'),
			array('name' => 'Bhután', 'id' => '028'),
			array('name' => 'Qatar', 'id' => '179'),
			array('name' => 'Martinica', 'id' => '142'),
			array('name' => 'Austria', 'id' => '017'),
			array('name' => 'Polonia', 'id' => '176'),
			array('name' => 'Mozambique', 'id' => '152'),
			array('name' => 'Uganda', 'id' => '228'),
			array('name' => 'Tuvalu', 'id' => '226'),
			array('name' => 'Papúa Nueva Guinea', 'id' => '171'),
			array('name' => 'Islas Cocos', 'id' => '051'),
			array('name' => 'Túnez', 'id' => '222'),
			array('name' => 'Malí', 'id' => '136'),
			array('name' => 'Guinea', 'id' => '096'),
			array('name' => 'República Democrática del Congo', 'id' => '054'),
			array('name' => 'Costa Rica', 'id' => '060'),
			array('name' => 'Bahamas', 'id' => '019'),
			array('name' => 'Guadalupe', 'id' => '092'),
			array('name' => 'Kazajstán', 'id' => '116'),
			array('name' => 'Bielorrusia', 'id' => '023'),
			array('name' => 'Islas Vírgenes Británicas', 'id' => '234'),
			array('name' => 'Botsuana', 'id' => '031'),
			array('name' => 'Islas Caimán', 'id' => '039'),
			array('name' => 'Nigeria', 'id' => '159'),
			array('name' => 'Groenlandia', 'id' => '091'),
			array('name' => 'Ecuador', 'id' => '066'),
			array('name' => 'Nueva Zelanda', 'id' => '164'),
			array('name' => 'Australia', 'id' => '016'),
			array('name' => 'Vanuatu', 'id' => '231'),
			array('name' => 'Islandia', 'id' => '110'),
			array('name' => 'El Salvador', 'id' => '068'),
			array('name' => 'Territorio Británico del Océano Índico', 'id' => '215'),
			array('name' => 'Guatemala', 'id' => '094'),
			array('name' => 'Corea del Norte', 'id' => '057'),
			array('name' => 'Irán', 'id' => '107'),
			array('name' => 'Yibuti', 'id' => '238'),
			array('name' => 'Zimbabue', 'id' => '240'),
			array('name' => 'Chile', 'id' => '046'),
			array('name' => 'Puerto Rico', 'id' => '178'),
			array('name' => 'Kiribati', 'id' => '119'),
			array('name' => 'Iraq', 'id' => '108'),
			array('name' => 'Hong Kong', 'id' => '103'),
			array('name' => 'Svalbard y Jan Mayen', 'id' => '210'),
			array('name' => 'Maldivas', 'id' => '135'),
			array('name' => 'Georgia', 'id' => '085'),
			array('name' => 'Brasil', 'id' => '033'),
			array('name' => 'Timor Oriental', 'id' => '217'),
			array('name' => 'Gambia', 'id' => '084'),
			array('name' => 'Noruega', 'id' => '162'),
			array('name' => 'Islas Salomón', 'id' => '186'),
			array('name' => 'Omán', 'id' => '165'),
			array('name' => 'Haití', 'id' => '100'),
			array('name' => 'Malta', 'id' => '137'),
			array('name' => 'Guinea-Bissau', 'id' => '098'),
			array('name' => 'Sierra Leona', 'id' => '199'),
			array('name' => 'Namibia', 'id' => '154'),
			array('name' => 'San Vicente y las Granadinas', 'id' => '192'),
			array('name' => 'Moldavia', 'id' => '148'),
			array('name' => 'Portugal', 'id' => '177'),
			array('name' => 'Estonia', 'id' => '076'),
			array('name' => 'Sahara Occidental', 'id' => '185'),
			array('name' => 'Islas Heard y McDonald', 'id' => '101'),
			array('name' => 'Suiza', 'id' => '208'),
			array('name' => 'Islas Feroe', 'id' => '078'),
			array('name' => 'Colombia', 'id' => '052'),
			array('name' => 'Dinamarca', 'id' => '063'),
			array('name' => 'Burundi', 'id' => '037'),
			array('name' => 'Nicaragua', 'id' => '157'),
			array('name' => 'México', 'id' => '146'),
			array('name' => 'Barbados', 'id' => '022'),
			array('name' => 'Seychelles', 'id' => '198'),
			array('name' => 'Madagascar', 'id' => '132'),
			array('name' => 'Palau', 'id' => '168'),
			array('name' => 'Granada', 'id' => '089'),
			array('name' => 'Reino Unido', 'id' => '180'),
			array('name' => 'Kenia', 'id' => '117'),
			array('name' => 'Laos', 'id' => '121'),
			array('name' => 'Islas Georgias del Sur y Sandwich del Sur', 'id' => '086'),
			array('name' => 'Taiwán', 'id' => '212'),
			array('name' => 'Antillas Holandesas', 'id' => '010'),
			array('name' => 'Ruanda', 'id' => '182'),
			array('name' => 'Anguilla', 'id' => '007'),
			array('name' => 'Venezuela', 'id' => '232'),
			array('name' => 'Polinesia Francesa', 'id' => '175'),
			array('name' => 'Islas Vírgenes de los Estados Unidos', 'id' => '235'),
			array('name' => 'Israel', 'id' => '111'),
			array('name' => 'Tonga', 'id' => '220'),
			array('name' => 'Kirguistán', 'id' => '118'),
			array('name' => 'Islas Marshall', 'id' => '141'),
			array('name' => 'Níger', 'id' => '158'),
			array('name' => 'Tayikistán', 'id' => '214'),
			array('name' => 'Bahréin', 'id' => '020'),
			array('name' => 'Senegal', 'id' => '196'),
			array('name' => 'Japón', 'id' => '114'),
			array('name' => 'Alemania', 'id' => '004'),
			array('name' => 'Líbano', 'id' => '124'),
			array('name' => 'Suecia', 'id' => '207'),
			array('name' => 'Tanzania', 'id' => '213'),
			array('name' => 'Eritrea', 'id' => '070'),
			array('name' => 'Bélgica', 'id' => '024'),
			array('name' => 'Samoa Americana', 'id' => '188'),
			array('name' => 'Mayotte', 'id' => '145'),
			array('name' => 'Montserrat', 'id' => '151'),
			array('name' => 'Ciudad del Vaticano', 'id' => '050'),
			array('name' => 'Belice', 'id' => '025'),
			array('name' => 'Sri Lanka', 'id' => '203'),
			array('name' => 'Perú', 'id' => '173'),
			array('name' => 'Jordania', 'id' => '115'),
			array('name' => 'Guyana', 'id' => '099'),
			array('name' => 'Nepal', 'id' => '156'),
			array('name' => 'Egipto', 'id' => '067'),
			array('name' => 'Luxemburgo', 'id' => '129'),
			array('name' => 'Costa de Marfil', 'id' => '059'),
			array('name' => 'Ucrania', 'id' => '227'),
			array('name' => 'Honduras', 'id' => '102'),
			array('name' => 'Myanmar', 'id' => '153'),
			array('name' => 'España', 'id' => '073'),
			array('name' => 'Liechtenstein', 'id' => '127'),
			array('name' => 'Isla de Navidad', 'id' => '049'),
			array('name' => 'Eslovenia', 'id' => '072'),
			array('name' => 'Surinam', 'id' => '209'),
			array('name' => 'Rumania', 'id' => '183'),
			array('name' => 'Congo', 'id' => '055'),
			array('name' => 'Lituania', 'id' => '128'),
			array('name' => 'Paraguay', 'id' => '172'),
			array('name' => 'Brunéi', 'id' => '034'),
			array('name' => 'Croacia', 'id' => '061'),
			array('name' => 'Zambia', 'id' => '239'),
			array('name' => 'Niue', 'id' => '160'),
		);

		foreach ($countries as $country){
			$entity = new Country();
			$entity->setId($country['id']);
			$entity->setName($country['name']);

			$metadata = $manager->getClassMetaData(get_class($entity));
			$metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);

			$manager->persist($entity);
		}

		$manager->flush();
	}
}