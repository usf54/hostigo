import React, { useEffect, useState } from "react";
import { useForm, usePage } from "@inertiajs/react";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";
import toast, { Toaster } from "react-hot-toast";

export default function CreateUser() {
    const { flash } = usePage().props;

    const [previewImage, setPreviewImage] = useState(null);

    useEffect(() => {
        if (flash?.success) toast.success(flash.success);
        if (flash?.error) toast.error(flash.error);
    }, [flash]);

    const { data, setData, post, errors, processing } = useForm({
        name: "",
        email: "",
        phone: "",
        role: "guest",
        password: "",
        password_confirmation: "",
        image: null,
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post("/users", {
            onSuccess: () => toast.success("User created successfully!"),
            onError: () => toast.error("Failed to create user."),
        });
    };

    const handleFileChange = (e) => {
        const file = e.target.files[0];
        setData("image", file);
        if (file) {
            const reader = new FileReader();
            reader.onload = () => setPreviewImage(reader.result);
            reader.readAsDataURL(file);
        } else {
            setPreviewImage(null);
        }
    };

    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />
                <div className="p-6 max-w-3xl">
                    <h1 className="text-2xl font-semibold mb-4">Create User</h1>

                    <form
                        onSubmit={handleSubmit}
                        className="bg-white p-6 rounded-lg shadow space-y-4"
                    >
                        {/* Name */}
                        <div>
                            <label className="block text-sm font-medium mb-1">Name</label>
                            <input
                                type="text"
                                value={data.name}
                                onChange={(e) => setData("name", e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            />
                            {errors.name && <p className="text-red-500 text-sm">{errors.name}</p>}
                        </div>

                        {/* Email */}
                        <div>
                            <label className="block text-sm font-medium mb-1">Email</label>
                            <input
                                type="email"
                                value={data.email}
                                onChange={(e) => setData("email", e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            />
                            {errors.email && <p className="text-red-500 text-sm">{errors.email}</p>}
                        </div>

                        {/* Phone */}
                        <div>
                            <label className="block text-sm font-medium mb-1">Phone</label>
                            <input
                                type="text"
                                value={data.phone}
                                onChange={(e) => setData("phone", e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            />
                            {errors.phone && <p className="text-red-500 text-sm">{errors.phone}</p>}
                        </div>

                        {/* Role */}
                        <div>
                            <label className="block text-sm font-medium mb-1">Role</label>
                            <select
                                value={data.role}
                                onChange={(e) => setData("role", e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            >
                                <option value="guest">Guest</option>
                                <option value="host">Host</option>
                                <option value="admin">Admin</option>
                            </select>
                            {errors.role && <p className="text-red-500 text-sm">{errors.role}</p>}
                        </div>

                        {/* Password */}
                        <div>
                            <label className="block text-sm font-medium mb-1">Password</label>
                            <input
                                type="password"
                                value={data.password}
                                onChange={(e) => setData("password", e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            />
                            {errors.password && <p className="text-red-500 text-sm">{errors.password}</p>}
                        </div>

                        {/* Confirm Password */}
                        <div>
                            <label className="block text-sm font-medium mb-1">Confirm Password</label>
                            <input
                                type="password"
                                value={data.password_confirmation}
                                onChange={(e) => setData("password_confirmation", e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            />
                        </div>

                        {/* Image */}
                        <div>
                            <label className="block text-sm font-medium mb-1">Profile Image</label>
                            <input
                                type="file"
                                onChange={handleFileChange}
                                className="mt-1 block w-full"
                            />
                            {previewImage && (
                                <img
                                    src={previewImage}
                                    alt="Preview"
                                    className="mt-2 w-20 h-20 object-cover rounded border"
                                />
                            )}
                            {errors.image && <p className="text-red-500 text-sm">{errors.image}</p>}
                        </div>

                        <button
                            type="submit"
                            disabled={processing}
                            className="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700"
                        >
                            {processing ? "Saving..." : "Create User"}
                        </button>
                    </form>
                </div>
            </SidebarInset>

            <Toaster position="top-right" />
        </SidebarProvider>
    );
}
