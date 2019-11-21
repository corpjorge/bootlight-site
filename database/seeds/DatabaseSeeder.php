<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AdminUsersTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(AreasitemsTableSeeder::class);
        $this->call(ParentescoTableSeeder::class);
        $this->call(FamiliaresTableSeeder::class);
        $this->call(CiudadesTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(MenuusersTableSeeder::class);
        $this->call(MenuuserssubTableSeeder::class);
        $this->call(AreasadminsTableSeeder::class);
        $this->call(AreasitemsadminTableSeeder::class);
        $this->call(MenuaadminsTableSeeder::class);
        $this->call(MenusadminsubTableSeeder::class);
        $this->call(alertsadminTableSeeder::class);
        $this->call(Documento_tiposTableSeeder::class);
        $this->call(AlmacenesTableSeeder::class);
        $this->call(GenerosTableSeeder::class);
        $this->call(Estado_vinculacionTableSeeder::class);
        $this->call(Estado_civilTableSeeder::class);
        $this->call(Users_detallesTableSeeder::class);
        $this->call(EstadosAprobacioneTableSeeder::class);
        $this->call(SegurosProductosTableSeeder::class);
        $this->call(SegurosDocumentosTableSeeder::class);
        $this->call(DependenciasTableSeeder::class);
        $this->call(CorreoNotificationsTableSeeder::class);
        $this->call(SimuladorTableSeeder::class);
        $this->call(SimuladorTasasTableSeeder::class);
*/
        $this->call(menu::class);




    }
}
