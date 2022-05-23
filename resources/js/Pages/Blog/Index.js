import React from "react";
import Authenticated from "@/Layouts/Authenticated";
import { Head } from "@inertiajs/inertia-react";

export default function Index(props) {
    return (
        <Authenticated
            auth={props.auth}
            errors={props.errors}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Blog
                </h2>
            }
        >
            <Head title="Blog Index" />

            <div className="py-12">
                {/* <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">
                            Blog Index
                        </div>
                    </div>
                </div> */}

                <div className="p-6 bg-white border-b border-gray-200">
                    <table>
                        <thead>
                            <tr>
                                <th>タイトル</th>
                                <th>コンテンツ</th>
                            </tr>
                        </thead>
                        <tbody>
                            {props.blogs.map((blog) => {
                                return (
                                    <tr key={blog.id}>
                                        <td className="border px-4 py-2">
                                            {blog.title}
                                        </td>
                                        <td className="border px-4 py-2">
                                            {blog.content}
                                        </td>
                                    </tr>
                                );
                            })}
                        </tbody>
                    </table>
                </div>
            </div>
        </Authenticated>
    );
}
