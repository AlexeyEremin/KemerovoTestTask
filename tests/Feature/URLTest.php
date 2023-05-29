<?php

namespace Tests\Feature;

use App\Models\Collaborator;
use App\Models\User;
use Tests\TestCase;

class URLTest extends TestCase
{
    /**
     * Проверка работы главной страницы
     *
     * @return void
     */
    public function test_open_main_page()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Проверка получения данных от сервера по запросу каждого загруженного сотрудника
     * Для проверки требуется выполнить операцию по заполнению базы через seeder
     *
     * @return void
     */
    public function test_open_first_report()
    {
        if (!Collaborator::find(1)) {
            $this->assertTrue(false, 'Загрузите seeder');
        }
        $response = $this->get('/api/getReport/1/1');
        $response->assertStatus(200);
    }

    /**
     * Проверка на вывод ошибки 404, при не существовании сотрудника
     *
     * @return void
     */
    public function test_open_not_found_report()
    {
        $response = $this->get('/api/getReport/-1/1');
        $response->assertStatus(404);
    }

    /**
     * Проверка на возможность открытие смены и закрытие
     *
     * @return void
     */
    public function test_open_work_time()
    {
        $token = User::find(1)->createToken(rand(29999, 9239388).now());
        $bearer = 'Bearer '.$token->plainTextToken;
        $response = $this->withHeaders(['Authorization' => $bearer])
            ->get('/api/work-time/1');
        $response->assertStatus(200);
    }

    /**
     * Проверка что без авторизации выполнения запроса не будет
     *
     * @return void
     */
    public function test_error_unAuthorization_work_time()
    {
        $response = $this->withHeaders([
                'Accept' => 'application/json'
            ])->get('/api/work-time/1');
        $response->assertStatus(401);
    }
}
