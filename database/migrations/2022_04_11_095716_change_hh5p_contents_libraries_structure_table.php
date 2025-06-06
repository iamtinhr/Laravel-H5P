<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\MySqlConnection;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeHh5pContentsLibrariesStructureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (strpos(DB::connection()->getName(), 'sqlite') !== FALSE) {
            return;
        }
        Schema::table('hh5p_contents_libraries', function (Blueprint $table) {
            $table->dropColumn('id');
        });
        Schema::table('hh5p_contents_libraries', function (Blueprint $table) {
            $table->dropUnique('hh5p_contents_libraries_unique_key');
        });
        Schema::table('hh5p_libraries_languages', function (Blueprint $table) {
            $table->dropUnique('hh5p_libraries_languages_unique_key');
        });
        Schema::table('hh5p_libraries_dependencies', function (Blueprint $table) {
            $table->dropUnique('hh5p_libraries_dependencies_unique_key');
        });
        Schema::table('hh5p_contents_libraries', function (Blueprint $table) {
            $table->primary(['content_id', 'library_id', 'dependency_type'], 'fk_primary');
        });
        Schema::table('hh5p_libraries_languages', function (Blueprint $table) {
            $table->dropColumn('id');
        });
        Schema::table('hh5p_libraries_languages', function (Blueprint $table) {
            $table->primary(['library_id', 'language_code'], 'fk_primary');
        });
        Schema::table('hh5p_libraries_dependencies', function (Blueprint $table) {
            $table->dropColumn('id');
        });
        Schema::table('hh5p_libraries_dependencies', function (Blueprint $table) {
            $table->primary(['library_id', 'required_library_id'], 'fk_primary');
        });
    }
}
