<?php
namespace Dentoleti\GeneralBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dentoleti\GeneralBundle\Entity\Country;
use Dentoleti\GeneralBundle\Entity\Province;

/**
 * Carga las provincias que manejará la aplicación.
 * Se insertarán solo los datos relacionados con España
 */
class Provinces extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 4;
	}

	public function load(ObjectManager $manager)
	{
		$provinces = array(
			array('name' => 'Pontevedra', 'id' => '038', 'country' => '073'),
			array('name' => 'Araba/Álava', 'id' => '001', 'country' => '073'),
			array('name' => 'Granada', 'id' => '018', 'country' => '073'),
			array('name' => 'Andorra', 'id' => '053', 'country' => '073'),
			array('name' => 'Palencia', 'id' => '036', 'country' => '073'),
			array('name' => 'Teruel', 'id' => '045', 'country' => '073'),
			array('name' => 'Badajoz', 'id' => '006', 'country' => '073'),
			array('name' => 'Guadalajara', 'id' => '019', 'country' => '073'),
			array('name' => 'Soria', 'id' => '028', 'country' => '073'),
			array('name' => 'Santa Cruz de Tenerife', 'id' => '040', 'country' => '073'),
			array('name' => 'Toledo', 'id' => '046', 'country' => '073'),
			array('name' => 'Asturias', 'id' => '035', 'country' => '073'),
			array('name' => 'Valencia', 'id' => '047', 'country' => '073'),
			array('name' => 'Gipuzkoa', 'id' => '020', 'country' => '073'),
			array('name' => 'Lleida', 'id' => '023', 'country' => '073'),
			array('name' => 'Castellón', 'id' => '012', 'country' => '073'),
			array('name' => 'Zaragoza', 'id' => '024', 'country' => '073'),
			array('name' => 'Salamanca', 'id' => '039', 'country' => '073'),
			array('name' => 'Girona', 'id' => '017', 'country' => '073'),
			array('name' => 'Huesca', 'id' => '022', 'country' => '073'),
			array('name' => 'Valladolid', 'id' => '048', 'country' => '073'),
			array('name' => 'Las Palmas', 'id' => '037', 'country' => '073'),
			array('name' => 'Melilla', 'id' => '052', 'country' => '073'),
			array('name' => 'Ourense', 'id' => '034', 'country' => '073'),
			array('name' => 'Cáceres', 'id' => '010', 'country' => '073'),
			array('name' => 'Zamora', 'id' => '050', 'country' => '073'),
			array('name' => 'Cuenca', 'id' => '016', 'country' => '073'),
			array('name' => 'Bizkaia', 'id' => '049', 'country' => '073'),
			array('name' => 'Tarragona', 'id' => '044', 'country' => '073'),
			array('name' => 'Murcia', 'id' => '032', 'country' => '073'),
			array('name' => 'Málaga', 'id' => '031', 'country' => '073'),
			array('name' => 'Cádiz', 'id' => '011', 'country' => '073'),
			array('name' => 'Illes Balears', 'id' => '007', 'country' => '073'),
			array('name' => 'Ciudad Real', 'id' => '013', 'country' => '073'),
			array('name' => 'Ávila', 'id' => '005', 'country' => '073'),
			array('name' => 'Ceuta', 'id' => '051', 'country' => '073'),
			array('name' => 'Alicante', 'id' => '003', 'country' => '073'),
			array('name' => 'Barcelona', 'id' => '008', 'country' => '073'),
			array('name' => 'Jaén', 'id' => '025', 'country' => '073'),
			array('name' => 'Lugo', 'id' => '029', 'country' => '073'),
			array('name' => 'Segovia', 'id' => '042', 'country' => '073'),
			array('name' => 'Navarra', 'id' => '033', 'country' => '073'),
			array('name' => 'Huelva', 'id' => '021', 'country' => '073'),
			array('name' => 'Albacete', 'id' => '002', 'country' => '073'),
			array('name' => 'Burgos', 'id' => '009', 'country' => '073'),
			array('name' => 'Córdoba', 'id' => '014', 'country' => '073'),
			array('name' => 'Almería', 'id' => '004', 'country' => '073'),
			array('name' => 'Madrid', 'id' => '030', 'country' => '073'),
			array('name' => 'Sevilla', 'id' => '043', 'country' => '073'),
			array('name' => 'Coruña', 'id' => '015', 'country' => '073'),
			array('name' => 'La Rioja', 'id' => '027', 'country' => '073'),
			array('name' => 'Cantabria', 'id' => '041', 'country' => '073'),
			array('name' => 'León', 'id' => '026', 'country' => '073'),
		);

		foreach ($provinces as $province) {
			$entity = new Province();

			$country = $manager->getRepository('DentoletiGeneralBundle:Country')->findOneById($province['country']);

			$entity->setId($province['id']);
			$entity->setName($province['name']);
			$entity->setCountry($country);

			$metadata = $manager->getClassMetaData(get_class($entity));
			$metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);

			$manager->persist($entity);
		}

		$manager->flush();
	}
}