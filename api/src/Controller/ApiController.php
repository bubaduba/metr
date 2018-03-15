<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Google\Auth\OAuth2;
use SymfonyBundles\RestBundle\Annotation\Rest;

class ApiController extends Controller
{
    /**
     * Всех юзеров
     * @Route("/users", defaults={"_format": "json"})
     * @Method({"GET"})
     */
    public function usersAction()
    {
        $serializer = $this->getSerializer(['password']);

        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findAll();

        return new Response($serializer->serialize($users, 'json'));
    }

    /**
     * @Route("/google-auth")
     * @Rest\Action(serializer={"groups"={"default"}})
     *
     */
    public function googleAuthAction()
    {
        $clientId = '137109043933-q8c6qoq6eppuphdlbo0k9vg46fhden14.apps.googleusercontent.com'; // Client ID
        $clientSecret = 'qhiNCeTOFJRtnwX9uoOq8fQ4'; // Client secret
        $redirectUri = 'http://127.0.0.1:8000/google-auth'; // Redirect URIs

        $url = 'https://accounts.google.com/o/oauth2/auth';

        $params = array(
            'redirect_uri'  => $redirectUri,
            'response_type' => 'code',
            'client_id'     => $clientId,
            'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
        );

        echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Аутентификация через Google</a></p>';

        if (isset($_GET['code'])) {
            $result = false;

            $params = array(
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
                'redirect_uri'  => $redirectUri,
                'grant_type'    => 'authorization_code',
                'code'          => $_GET['code']
            );

            $url = 'https://accounts.google.com/o/oauth2/token';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($curl);
            curl_close($curl);
            $tokenInfo = json_decode($result, true);

            if (isset($tokenInfo['access_token'])) {
                $params['access_token'] = $tokenInfo['access_token'];

                $linkGetUserInfo = 'https://www.googleapis.com/oauth2/v1/userinfo';
                $userInfo = json_decode(
                    file_get_contents($linkGetUserInfo . '?' . urldecode(http_build_query($params))),
                    true
                );
                if (isset($userInfo['id'])) {
                    $userInfo = $userInfo;
                    $result = true;
                }
            }

            if ($result) {

                $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(
                    ['email' => $userInfo['email'],]
                );

                $entityManager = $this->getDoctrine()->getManager();

                if (!$user) {
                    $user = new User();
                    $user->setWhenAdd(new \DateTime());
                }

                $user->setLogin($userInfo['email']);
                $user->setEmail($userInfo['email']);
                $user->setName($userInfo['given_name']);
                $user->setFamily($userInfo['family_name']);
                $user->setGender($userInfo['gender']);
                $user->setPicture($userInfo['picture']);
                $user->setToken($tokenInfo['access_token']);
                $user->setWhenAddToken(new \DateTime());

                $entityManager->persist($user);
                $entityManager->flush();
            }
            return $user;
        }
    }

    /**
     * Одного юзера
     * @Route("/user/{id}", defaults={"_format": "json"})
     * @Method({"GET"})
     */
    public function getUserAction($id)
    {
        $serializer = $this->getSerializer(['password', 'whenAdd', 'whenAddToken']);

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneBy(['id' => $id]);

        //return new Response($serializer->serialize($user, 'json'));
        return $user->getCounters();
    }

    /**
     * Оновлення юзера
     * @Route("/user/{id}", defaults={"_format": "json"})
     * @Method({"PUT"})
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function updateUserAction($id, Request $request)
    {
        $name = $request->get('login');
        $email = $request->get('email');

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneBy(['id' => $id]);
        $user->setLogin($name);

        $em->flush();

        $serializer = $this->getSerializer(['password']);

        return new Response($serializer->serialize($user, 'json'));
    }

    /**
     * @Route("/user/{id}")
     * @Method({"DELETE"})
     */
    public function deleteAction($id)
    {
        $data = new User;
        $sn = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        if (empty($user)) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        }
        else {
            $sn->remove($user);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }

    /**
     * @param array $ignored
     * @return Serializer
     */
    private function getSerializer($ignored = [])
    {
        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes($ignored);
        $encoder = new JsonEncoder();

        return new Serializer([$normalizer], [$encoder]);
    }

}
