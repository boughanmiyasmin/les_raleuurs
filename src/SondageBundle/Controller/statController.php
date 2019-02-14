<?php

namespace SondageBundle\Controller;

use SondageBundle\Entity\Sondage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use SondageBundle\Entity\ReponseSondage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use SondageBundle\Repository\SondageRepository;
use Ob\HighchartsBundle\Highcharts\AbstractChart;
use Ob\HighchartsBundle\Highcharts\ChartOption;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Ob\HighchartsBundle\Highcharts\Highstock;




class statController extends Controller
{
/**
* @Route("/stats", name="stat")
* @return \Symfony\Component\HttpFoundation\Response
*/

        public function chartAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('linechart');
        $ob->title->text('Browser market shares at a specific website in 2010');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('Firefox', 45.0),
            array('IE', 26.8),
            array('Chrome', 12.8),
            array('Safari', 8.5),
            array('Opera', 6.2),
            array('Others', 0.7),
        );
        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));

        return $this->render("SondageBundle:Default:test.html.twig", array(
            'chart' => $ob
        ));
    }

}