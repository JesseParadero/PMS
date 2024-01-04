<?php

return [
    'default' => [
        'request' => [
            'invalid' => '無効なリクエスト',
        ],
        'success' => [
            'read' => ':name の取得が完了しました',
            'create' => ':name の作成が完了しました',
            'update' => ':name の更新が完了しました',
            'delete' => ':name の削除が完了しました',
        ],
        'failed' => [
            'read' => ':name の取得に失敗しました',
            'create' => ':name の作成に失敗しました',
            'update' => ':name の更新に失敗しました',
            'delete' => ':name を削除できませんでした',
            'login' => 'アカウント及びパスワードが一致しません',
        ],
    ],
    // A

    // B

    // C

    // D
    'delete_route' => 'language.destroy',
    'delete_level_route' => 'level.destroy',
    'delete_criteria_route' => 'criteria.destroy',
    'delete_sub_criteria_route' => 'sub-criteria.destroy',
    'development' => [
        'store' => 'development.store',
        'update' => 'development.update',
        'destroy' => 'development.destroy',
    ],
    // E
    'edit_route' => 'language.edit',
    'edit_level_route' => 'language.editLevel',
    'evaluation' => [
        'store' => 'evaluation.store',
        'update' => 'evaluation.update',
        'destroy' => 'evaluation.destroy',
    ],
    'evaluate' => [
        'languages' => 'evaluate.programming-languages',
        'LevelItem' => 'evaluate.levelItem',
        'rating' => 'evaluate.ratings',
    ],

    // F

    // G

    // H

    // I
    'InvalidCredential' => '無効な資格情報',
    // K

    // L
    'LoginSuccessfully' => 'ログインに成功しました',
    'LogoutSuccessfully' => 'ログアウトに成功しました',
    // M

    // N
    'notFound' => ':name 見つかりません',
    // O

    // P

    // Q

    // R
    'rating_update' => 'rating.update',
    'rating_destroy' => 'rating.destroy',
    'rating_store' => 'rating.store',
    // S
    'store_route' => 'language.store',
    'store_or_update_level_route' => 'level.storeOrUpdate',
    'store_or_update_criteria_route' => 'criteria.storeOrUpdate',
    'store_or_update_sub_criteria_route' => 'sub-criteria.storeOrUpdate',
    'show_criteria_route' => 'criteria.show',
    'show_sub_criteria_route' => 'sub-criteria.show',
    'show_level_item_route' => 'level.show',
    // T

    // U
    'update_route' => 'language.update'
    // V

    // W

    // X

    // Y

    // Z
];
