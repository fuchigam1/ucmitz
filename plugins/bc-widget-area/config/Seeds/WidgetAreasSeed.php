<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * WidgetAreas seed.
 */
class WidgetAreasSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => '標準サイドバー',
                'widgets' => 'YTozOntpOjA7YToxOntzOjc6IldpZGdldDQiO2E6OTp7czoyOiJpZCI7czoxOiI0IjtzOjQ6InR5cGUiO3M6MTI6IuODhuOCreOCueODiCI7czo3OiJlbGVtZW50IjtzOjQ6InRleHQiO3M6NjoicGx1Z2luIjtzOjk6IkJhc2VyQ29yZSI7czo0OiJzb3J0IjtpOjM7czo0OiJuYW1lIjtzOjk6IuODquODs+OCryI7czo0OiJ0ZXh0IjtzOjQ0MjoiPHAgc3R5bGU9Im1hcmdpbi1ib3R0b206MjBweDt0ZXh0LWFsaWduOiBjZW50ZXIiPiA8YSBocmVmPSJodHRwczovL2Jhc2VyY21zLm5ldCIgdGFyZ2V0PSJfYmxhbmsiPjxpbWcgc3JjPSJodHRwczovL2Jhc2VyY21zLm5ldC9pbWcvYm5yX2Jhc2VyY21zLmpwZyIgYWx0PSLjgrPjg7zjg53jg6zjg7zjg4jjgrXjgqTjg4jjgavjgaHjgofjgYbjganjgYTjgYRDTVPjgIFiYXNlckNNUyIvPjwvYT48L3A+PHAgY2xhc3M9ImN1c3RvbWl6ZS1uYXZpIGNvcm5lcjEwIj48c21hbGw+44GT44Gu6YOo5YiG44Gv44CB566h55CG55S76Z2i44GuIFvoqK3lrppdIOKGkiBb44Om44O844OG44Kj44Oq44OG44KjXSDihpIgW+OCpuOCo+OCuOOCp+ODg+ODiOOCqOODquOCol0g4oaSIFvmqJnmupbjgrXjgqTjg4njg5Djg7xdIOOCiOOCiue3qOmbhuOBp+OBjeOBvuOBmeOAgjwvc21hbGw+PC9wPiI7czo5OiJ1c2VfdGl0bGUiO3M6MToiMSI7czo2OiJzdGF0dXMiO3M6MToiMSI7fX1pOjE7YToxOntzOjc6IldpZGdldDIiO2E6OTp7czoyOiJpZCI7czoxOiIyIjtzOjQ6InR5cGUiO3M6MzM6IuODreODvOOCq+ODq+ODiuODk+OCsuODvOOCt+ODp+ODsyI7czo3OiJlbGVtZW50IjtzOjEwOiJsb2NhbF9uYXZpIjtzOjY6InBsdWdpbiI7czo5OiJCYXNlckNvcmUiO3M6NDoic29ydCI7aToxO3M6NDoibmFtZSI7czozMzoi44Ot44O844Kr44Or44OK44OT44Ky44O844K344On44OzIjtzOjU6ImNhY2hlIjtzOjE6IjEiO3M6OToidXNlX3RpdGxlIjtzOjE6IjEiO3M6Njoic3RhdHVzIjtzOjE6IjEiO319aToyO2E6MTp7czo3OiJXaWRnZXQzIjthOjg6e3M6MjoiaWQiO3M6MToiMyI7czo0OiJ0eXBlIjtzOjE4OiLjgrXjgqTjg4jlhoXmpJzntKIiO3M6NzoiZWxlbWVudCI7czo2OiJzZWFyY2giO3M6NjoicGx1Z2luIjtzOjk6IkJhc2VyQ29yZSI7czo0OiJzb3J0IjtpOjI7czo0OiJuYW1lIjtzOjE4OiLjgrXjgqTjg4jlhoXmpJzntKIiO3M6OToidXNlX3RpdGxlIjtzOjE6IjEiO3M6Njoic3RhdHVzIjtzOjE6IjEiO319fQ==',
                'modified' => '2020-12-14 14:34:10',
                'created' => '2015-06-26 20:34:07',
            ],
            [
                'id' => 2,
                'name' => 'ブログサイドバー',
                'widgets' => 'YTo2OntpOjA7YToxOntzOjc6IldpZGdldDYiO2E6MTI6e3M6MjoiaWQiO3M6MToiNiI7czo0OiJ0eXBlIjtzOjI3OiLlubTliKXjgqLjg7zjgqvjgqTjg5bkuIDopqciO3M6NzoiZWxlbWVudCI7czoyMDoiYmxvZ195ZWFybHlfYXJjaGl2ZXMiO3M6NjoicGx1Z2luIjtzOjY6IkJjQmxvZyI7czo0OiJzb3J0IjtpOjY7czo0OiJuYW1lIjtzOjI3OiLlubTliKXjgqLjg7zjgqvjgqTjg5bkuIDopqciO3M6NToibGltaXQiO3M6MDoiIjtzOjEwOiJ2aWV3X2NvdW50IjtzOjE6IjEiO3M6MTE6InN0YXJ0X21vbnRoIjtzOjE6IjEiO3M6MTU6ImJsb2dfY29udGVudF9pZCI7czoxOiIxIjtzOjk6InVzZV90aXRsZSI7czoxOiIxIjtzOjY6InN0YXR1cyI7czoxOiIxIjt9fWk6MTthOjE6e3M6NzoiV2lkZ2V0MSI7YTo5OntzOjI6ImlkIjtzOjE6IjEiO3M6NDoidHlwZSI7czoyNDoi44OW44Ot44Kw44Kr44Os44Oz44OA44O8IjtzOjc6ImVsZW1lbnQiO3M6MTM6ImJsb2dfY2FsZW5kYXIiO3M6NjoicGx1Z2luIjtzOjY6IkJjQmxvZyI7czo0OiJzb3J0IjtpOjE7czo0OiJuYW1lIjtzOjI0OiLjg5bjg63jgrDjgqvjg6zjg7Pjg4Djg7wiO3M6MTU6ImJsb2dfY29udGVudF9pZCI7czoxOiIxIjtzOjk6InVzZV90aXRsZSI7czoxOiIwIjtzOjY6InN0YXR1cyI7czoxOiIxIjt9fWk6MjthOjE6e3M6NzoiV2lkZ2V0MiI7YToxMzp7czoyOiJpZCI7czoxOiIyIjtzOjQ6InR5cGUiO3M6MTg6IuOCq+ODhuOCtOODquS4gOimpyI7czo3OiJlbGVtZW50IjtzOjIyOiJibG9nX2NhdGVnb3J5X2FyY2hpdmVzIjtzOjY6InBsdWdpbiI7czo2OiJCY0Jsb2ciO3M6NDoic29ydCI7aToyO3M6NDoibmFtZSI7czoxODoi44Kr44OG44K044Oq5LiA6KanIjtzOjU6ImxpbWl0IjtzOjA6IiI7czoxMDoidmlld19jb3VudCI7czoxOiIxIjtzOjc6ImJ5X3llYXIiO3M6MToiMCI7czo1OiJkZXB0aCI7czoxOiIxIjtzOjE1OiJibG9nX2NvbnRlbnRfaWQiO3M6MToiMSI7czo5OiJ1c2VfdGl0bGUiO3M6MToiMSI7czo2OiJzdGF0dXMiO3M6MToiMSI7fX1pOjM7YToxOntzOjc6IldpZGdldDMiO2E6MTA6e3M6MjoiaWQiO3M6MToiMyI7czo0OiJ0eXBlIjtzOjE1OiLmnIDov5Hjga7mipXnqL8iO3M6NzoiZWxlbWVudCI7czoxOToiYmxvZ19yZWNlbnRfZW50cmllcyI7czo2OiJwbHVnaW4iO3M6NjoiQmNCbG9nIjtzOjQ6InNvcnQiO2k6MztzOjQ6Im5hbWUiO3M6MTU6IuacgOi/keOBruaKleeovyI7czo1OiJjb3VudCI7czoxOiI1IjtzOjE1OiJibG9nX2NvbnRlbnRfaWQiO3M6MToiMSI7czo5OiJ1c2VfdGl0bGUiO3M6MToiMSI7czo2OiJzdGF0dXMiO3M6MToiMSI7fX1pOjQ7YToxOntzOjc6IldpZGdldDQiO2E6MTA6e3M6MjoiaWQiO3M6MToiNCI7czo0OiJ0eXBlIjtzOjI0OiLjg5bjg63jgrDmipXnqL/ogIXkuIDopqciO3M6NzoiZWxlbWVudCI7czoyMDoiYmxvZ19hdXRob3JfYXJjaGl2ZXMiO3M6NjoicGx1Z2luIjtzOjY6IkJjQmxvZyI7czo0OiJzb3J0IjtpOjQ7czo0OiJuYW1lIjtzOjE1OiLmipXnqL/ogIXkuIDopqciO3M6MTA6InZpZXdfY291bnQiO3M6MToiMSI7czoxNToiYmxvZ19jb250ZW50X2lkIjtzOjE6IjEiO3M6OToidXNlX3RpdGxlIjtzOjE6IjEiO3M6Njoic3RhdHVzIjtzOjE6IjEiO319aTo1O2E6MTp7czo3OiJXaWRnZXQ1IjthOjExOntzOjI6ImlkIjtzOjE6IjUiO3M6NDoidHlwZSI7czoyNzoi5pyI5Yil44Ki44O844Kr44Kk44OW5LiA6KanIjtzOjc6ImVsZW1lbnQiO3M6MjE6ImJsb2dfbW9udGhseV9hcmNoaXZlcyI7czo2OiJwbHVnaW4iO3M6NjoiQmNCbG9nIjtzOjQ6InNvcnQiO2k6NTtzOjQ6Im5hbWUiO3M6Mjc6IuaciOWIpeOCouODvOOCq+OCpOODluS4gOimpyI7czo1OiJsaW1pdCI7czoyOiIxMiI7czoxMDoidmlld19jb3VudCI7czoxOiIxIjtzOjE1OiJibG9nX2NvbnRlbnRfaWQiO3M6MToiMSI7czo5OiJ1c2VfdGl0bGUiO3M6MToiMSI7czo2OiJzdGF0dXMiO3M6MToiMSI7fX19',
                'modified' => '2020-09-14 20:16:49',
                'created' => '2015-06-26 20:34:07',
            ],
        ];

        $table = $this->table('widget_areas');
        $table->insert($data)->save();
    }
}
