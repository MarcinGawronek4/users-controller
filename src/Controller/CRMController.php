<?php
    namespace App\Controller;

    use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;
use App\Entity\Role;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CRMController extends Controller
{

    private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
        $this->passwordEncoder = $passwordEncoder;
     }

    private function serialize($data)
    {
        return $this->get('serializer')
            ->serialize($data, 'json', array('groups' => array('group1')));
    }

    
     /**
     * Route("/api/all")
     * @Method("GET")
     */
    public function getAll()
    {
        $user = $this->getDoctrine()->getEntityManager();
        $query = $user->createQuery(
             'SELECT u,r from App\Entity\User u INNER JOIN u.role r WHERE u.deleted = false'
        );
        
         $array = $query->getArrayResult();
         $response = new Response(json_encode($array));
         $response->headers->set('Content-Type', 'application/json');
         $response->headers->set('Access-Control-Allow-Origin', '*');

         return $response;
    }

    /**
     * Route("/api/{id}")
     * @Method("GET")
     */
    public function getOneUser($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        //$user = $em->getRepository(User::class)->find($id);
        $query = $em->createQuery(
            'SELECT u,r from App\Entity\User u INNER JOIN u.role r WHERE u.id = :id'
       )->setParameter('id', $id);
       $array = $query->getArrayResult();
       $response = new Response(json_encode($array));
         
         $response->headers->set('Content-Type', 'application/json');
         $response->headers->set('Access-Control-Allow-Origin', '*');

         return $response;
    }


    /**
     * @Route("/api/delete/{id}")
     *
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository(User::class)->find($id);
        $user->setDeleted(true);
        $em->persist($user);
        $em->flush();
        $response = new Response(null, 204);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @Route("/api/post", methods="POST")
     *
     */
    public function post(Request $request)
    {

        
        $em = $this->getDoctrine()->getEntityManager();
        $content = json_decode(
            $request->getContent(),
           true
        );

        $user = new User;
        $user->setLogin($content["username"]);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            $content["password"]
        ));
        $user->setName($content["name"]);
        $user->setSurname($content["surname"]);
        $user->setDateOfBirth(new \DateTime($content["dateOfBirth"]));
        $user->setDeleted(false);
        $user->setRole($em->getRepository(Role::class)->findOneBy(['name' => $content["role"]]));
        $em->persist($user);
        $em->flush();
        exit(\Doctrine\Common\Util\Debug::dump($content));
        $response = new JsonResponse(
            [
                'status' => 'ok',
            ],
            JsonResponse::HTTP_CREATED
        );
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @Route("/api/edit/{id}", methods="PUT")
     *
     */

    public function edit($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository(User::class)->find($id);
        $content = json_decode(
            $request->getContent(),
            true
        );
        if ($user){
            $user->setLogin($content["username"]);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $content["password"]
            ));
            $user->setName($content["name"]);
            $user->setSurname($content["surname"]);
            $user->setDateOfBirth(new \DateTime($content["dateOfBirth"]));
            $user->setDeleted(false);
            $user->setRole($em->getRepository(Role::class)->findOneBy(['name' => $content["role"]]));
        }
        $em->persist($user);
        $em->flush();
        $response = new JsonResponse(
            [
                'status' => 'ok',
            ],
            JsonResponse::HTTP_CREATED
        );
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
        
    }
    


    

}