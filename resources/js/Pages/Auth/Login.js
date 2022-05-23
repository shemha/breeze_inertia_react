import React, { useEffect } from "react";
// /reffect/breeze_inertia_react/resources/js/Components/Button.js
import Button from "@/Components/Button";
// /reffect/breeze_inertia_react/resources/js/Components/Checkbox.js
import Checkbox from "@/Components/Checkbox";
// /reffect/breeze_inertia_react/resources/js/Layouts/Guest.js
import Guest from "@/Layouts/Guest";
// /reffect/breeze_inertia_react/resources/js/Components/Input.js
import Input from "@/Components/Input";
// /reffect/breeze_inertia_react/resources/js/Components/Label.js
import Label from "@/Components/Label";
// /reffect/breeze_inertia_react/resources/js/Components/ValidationErrors.js
import ValidationErrors from "@/Components/ValidationErrors";
// /reffect/breeze_inertia_react/node_modules/@inertiajs/inertia-react/index.d.ts
import { Head, Link, useForm } from "@inertiajs/inertia-react";

// 外部参照可能な関数コンポーネントLogin
// reffect/breeze_inertia_react/app/Http/Controllers/Auth/AuthenticatedSessionController.php
// create関数から受け取ったstatusプロパティとcanResetPasswordプロパティをPropsとして利用
export default function Login({ status, canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        // input要素の初期値を設定、dataオブジェクトのプロパティとして参照可能
        // メールフォーム・パスワードフォーム・チェックボックスの3要素を保存できるプロパティを設定
        // メールアドレスのプロパティを設定、文字列が入る
        email: "",
        // パスワードのプロパティを設定、文字列が入る
        password: "",
        // チェックボックスの状態に関するプロパティを設定、文字列が入る
        remember: "",
    });

    useEffect(() => {
        return () => {
            // 状態を初期化する関数、初期値を'password'に設定
            reset("password");
        };
    }, []);

    // ハンドルチェンジイベント
    const onHandleChange = (event) => {
        // フォームのname属性を取得
        // フォームのtype属性が'checkbox'の場合はchecked属性を、そうでない場合value属性を取得
        setData(
            event.target.name,
            event.target.type === "checkbox"
                ? event.target.checked
                : event.target.value
        );
    };

    // データ送信イベント
    const submit = (e) => {
        // フォームのデフォルトイベントをキャンセル
        e.preventDefault();

        // "/login"へPOST送信
        post(route("login"));
    };

    return (
        <Guest>
            <Head title="Log in" />

            {status && (
                <div className="mb-4 font-medium text-sm text-green-600">
                    {status}
                </div>
            )}

            <ValidationErrors errors={errors} />

            <form onSubmit={submit}>
                <div>
                    <Label forInput="email" value="Email" />

                    <Input
                        type="text"
                        name="email"
                        value={data.email}
                        className="mt-1 block w-full"
                        autoComplete="username"
                        isFocused={true}
                        handleChange={onHandleChange}
                    />
                </div>

                <div className="mt-4">
                    <Label forInput="password" value="Password" />

                    <Input
                        type="password"
                        name="password"
                        value={data.password}
                        className="mt-1 block w-full"
                        autoComplete="current-password"
                        handleChange={onHandleChange}
                    />
                </div>

                <div className="block mt-4">
                    <label className="flex items-center">
                        <Checkbox
                            name="remember"
                            value={data.remember}
                            handleChange={onHandleChange}
                        />

                        <span className="ml-2 text-sm text-gray-600">
                            Remember me
                        </span>
                    </label>
                </div>

                <div className="flex items-center justify-end mt-4">
                    {canResetPassword && (
                        <Link
                            href={route("password.request")}
                            className="underline text-sm text-gray-600 hover:text-gray-900"
                        >
                            Forgot your password?
                        </Link>
                    )}

                    <Button className="ml-4" processing={processing}>
                        Log in
                    </Button>
                </div>
            </form>
        </Guest>
    );
}
