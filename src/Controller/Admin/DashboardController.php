<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Category;
use App\Entity\Post;
use App\Entity\Relation;
use App\Entity\Type;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestion : Bloom.At');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Posts', 'fas fa-file-alt', Post::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Categories', 'fa fa-tag', Category::class);
        yield MenuItem::linkToCrud('Type de posts', 'fa fa-list', Type::class);
        yield MenuItem::linkToCrud('Type de relation', 'fas fa-people-arrows', Relation::class);
    }
}
