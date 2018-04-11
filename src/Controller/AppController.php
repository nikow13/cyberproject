<?php

namespace App\Controller;

use App\Infra\ChooseTextType;
use App\Infra\Comparator;
use App\Infra\Reader;
use App\Infra\XorDecryptor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    /**
     * @Route("/", name="app")
     */
    public function index(Request $request)
    {
        $commonWords   = null;
        $validatedKey  = null;
        $textDecrypted = null;
        $text          = 'PA';

        $reader      = new Reader();
        $xorDecrytor = new XorDecryptor();
        $comparator  = new Comparator();

        $dicoWords = $reader->read(__DIR__.'/../Resources/liste_francais.txt');
        $keys      = $reader->read(__DIR__.'/../Resources/possibleKeys');

        $form    = $this->createForm(ChooseTextType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $text = $form['text']->getData();
        }


        foreach ($keys as $key) {
            $key    = str_replace("\n", '', $key);
            $output = $xorDecrytor->xorThis(file_get_contents(__DIR__.'/../Resources/files_crypted/' . $text . '.txt'), $key);
            $words  = explode(" ", $output);

            $result = $comparator->compare($words, implode($dicoWords), $key);

            if ($result['words'] > 100) {
                $validatedKey  = $result['key'];
                $commonWords   = $result['words'];
                $textDecrypted = utf8_encode($output);
            }
        }

        return $this->render('app/index.html.twig', [
            'form'            => $form->createView(),
            'commonWords'     => $commonWords,
            'validatedKey'    => $validatedKey,
            'textDecrypted'   => $textDecrypted,
        ]);
    }
}
