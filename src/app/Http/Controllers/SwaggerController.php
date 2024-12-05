<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

//  Контроллер используется для вынесения в отдельный файл документации для Swagger

/**
 *
 * @OA\Info(
 *      title="We Rent API",
 *      version="1.0.0"
 * ),
 *
 * @OA\PathItem(
 *      path="/api/"
 * ),
 *
 * @OA\Post(
 *     path="/api/guests",
 *     summary="Добавить нового гостя",
 *     tags={"Guest"},
 *
 *  @OA\RequestBody(
 *      @OA\JsonContent(
 *          allOf={
 *              @OA\Schema(
 *                  @OA\Property(property="first_name", type="string", example="Ivan"),
 *                  @OA\Property(property="last_name", type="string", example="Ivanov"),
 *                  @OA\Property(property="phone", type="string", example="+7-960-399-17-11"),
 *                  @OA\Property(property="email", type="email", example="test@mail.ru"),
 *                  @OA\Property(property="country", type="string", example="Russia"),
 *                  )
 *                }
 *              )
 *            ),
 *
 * @OA\Response(
 *      response=200,
 *      description="Запись успешно создана",
 *      @OA\JsonContent(
 *      @OA\Property(property="data", type="object",
 *          @OA\Property(property="first_name", type="string", example="Ivan"),
 *          @OA\Property(property="last_name", type="string", example="Ivanov"),
 *          @OA\Property(property="phone", type="string", example="+7-960-399-17-11"),
 *          @OA\Property(property="email", type="string", example="test@mail.ru"),
 *          @OA\Property(property="country", type="string", example="Russia"),
 *          @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-14T14:53:10.000000Z"),
 *          @OA\Property(property="created_at", type="string", format="date-time", example="2023-11-14T14:53:10.000000Z"),
 *          @OA\Property(property="id", type="integer", example=5),
 *          ),
 *        ),
 *      ),
 *
 * @OA\Get(
 *  path="/api/guests",
 *  summary="Вывести список всех гостей",
 *  tags={"Guest"},
 * @OA\Response(
 *  response=200,
 *  description="Готово",
 *  @OA\JsonContent(
 *       @OA\Property(property="data", type="array", @OA\Items(
 *          @OA\Property(property="id", type="integer", example=5),
 *          @OA\Property(property="first_name", type="string", example="Ivan"),
 *          @OA\Property(property="last_name", type="string", example="Ivanov"),
 *          @OA\Property(property="phone", type="string", example="+7-960-399-17-11"),
 *          @OA\Property(property="email", type="string", example="test@mail.ru"),
 *          @OA\Property(property="country", type="string", example="Russia"),
 *          @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-14T14:53:10.000000Z"),
 *          @OA\Property(property="created_at", type="string", format="date-time", example="2023-11-14T14:53:10.000000Z"),
 *       ),
 *     ),
 *
 *          ),
 *        ),
 *      ),
 *
 * @OA\Get(
 *      path="/api/guests/{guest}",
 *      summary="Вывести гостя по ID",
 *      tags={"Guest"},
 * @OA\Parameter(
 *      description="Guest ID",
 *      in="path",
 *      name="guest",
 *      required=true,
 *      example=1
 *      ),
 *
 * @OA\Response(
 *      response=200,
 *      description="Успешный вывод гостя",
 *      @OA\JsonContent(
 *          @OA\Property(property="content", type="object",
 *              @OA\Property(property="id", type="integer", example=5),
 *              @OA\Property(property="first_name", type="string", example="Ivan"),
 *              @OA\Property(property="last_name", type="string", example="Ivanov"),
 *              @OA\Property(property="phone", type="string", example="+7-960-399-17-11"),
 *              @OA\Property(property="email", type="string", example="test@mail.ru"),
 *              @OA\Property(property="country", type="string", example="Russia"),
 *              @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-14T14:53:10.000000Z"),
 *              @OA\Property(property="created_at", type="string", format="date-time", example="2023-11-14T14:53:10.000000Z")
 *              ),
 *            ),
 *          ),
 *        ),
 *
 * @OA\Put(
 *      path="/api/guests/{guest}",
 *      summary="Обновить информацию о госте",
 *      tags={"Guest"},
 *      @OA\Parameter(
 *          description="Guest ID",
 *          in="path",
 *          name="guest",
 *          required=true,
 *          example=1
 *      ),
 *
 * @OA\RequestBody(
 *   @OA\JsonContent(
 *      allOf={
 *          @OA\Schema(
 *          @OA\Property(property="first_name", type="string", example="Ivan"),
 *          @OA\Property(property="last_name", type="string", example="Ivanov"),
 *          @OA\Property(property="phone", type="string", example="+7-960-399-17-11"),
 *          @OA\Property(property="email", type="email", example="test@mail.ru"),
 *          @OA\Property(property="country", type="string", example="Russia"),
 *                    )
 *                  }
 *                )
 *              ),
 *
 * @OA\Response(
 *      response=200,
 *      description="Запись успешно обновлена",
 *      @OA\JsonContent(
 *          @OA\Property(property="data", type="object",
 *          @OA\Property(property="id", type="integer", example=5),
 *          @OA\Property(property="first_name", type="string", example="Ivan"),
 *          @OA\Property(property="last_name", type="string", example="Ivanov"),
 *          @OA\Property(property="phone", type="string", example="+7-960-399-17-11"),
 *          @OA\Property(property="email", type="string", example="test@mail.ru"),
 *          @OA\Property(property="country", type="string", example="Russia"),
 *          @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-14T14:53:10.000000Z"),
 *          @OA\Property(property="created_at", type="string", format="date-time", example="2023-11-14T14:53:10.000000Z"),
 *                      ),),
 *                    ),
 *                  ),
 *                ),
 *
 * @OA\Delete(
 *      path="/api/guests/{guest}",
 *      summary="Удалить гостя",
 *      tags={"Guest"},
 * @OA\Parameter(
 *      description="Guest ID",
 *      in="path",
 *      name="guest",
 *      required=true,
 *      example=1
 * ),
 *
 * @OA\Response(
 *      response=200,
 *      description="Запись успешно удалена",
 *      @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Запись успешно удалена"),
 *              ),
 *            ),
 *          ),
 */
class SwaggerController extends Controller {}
