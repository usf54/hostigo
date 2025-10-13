import React, { useState, useEffect } from "react";
import { usePage, router } from "@inertiajs/react";
import toast, { Toaster } from "react-hot-toast";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";

export default function EditUser() {
    const { user, flash, errors } = usePage().props;

    // Form state
    const [name, setName] = useState(user.name || "");
    const [email, setEmail] = useState(user.email || "");
    const [phone, setPhone] = useState(user.phone || "");
    const [role, setRole] = useState(user.role || "guest");
    const [password, setPassword] = useState("");
    const [passwordConfirmation, setPasswordConfirmation] = useState("");
    const [image, setImage] = useState(null);
    const [previewImage, setPreviewImage] = useState(
        user.image ? (user.image.startsWith("http") ? user.image : `/storage/${user.image}`) : null
    );

    // Toast messages
    useEffect(() => {
        if (flash?.success) toast.success(flash.success);
        if (flash?.error) toast.error(flash.error);
    }, [flash]);

    const handleFileChange = (e) => {
        const file = e.target.files[0];
        setImage(file);
        if (file) {
            const reader = new FileReader();
            reader.onload = () => setPreviewImage(reader.result);
            reader.readAsDataURL(file);
        } else {
            setPreviewImage(user.image ? `/storage/${user.image}` : null);
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        const formData = new FormData();
        formData.append("_method", "PUT");
        formData.append("name", name);
        formData.append("email", email);
        formData.append("phone", phone);
        formData.append("role", role);
        if (password) formData.append("password", password);
        if (passwordConfirmation) formData.append("password_confirmation", passwordConfirmation);
        if (image) formData.append("image", image);

        router.post(`/users/${user.id}`, formData, {
            forceFormData: true,
            preserveScroll: true,
            onSuccess: () => toast.success("User updated successfully!"),
            onError: (errors) => toast.error("There were errors in your submission"),
        });
    };

    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />
                <div className="p-6 max-w-3xl">
                    <h1 className="text-2xl font-semibold mb-4">Edit User</h1>

                    <form
                        onSubmit={handleSubmit}
                        className="bg-white shadow-md rounded-lg p-6 space-y-4"
                    >
                        {/* Name */}
                        <div>
                            <label className="block text-sm font-medium mb-1">Name</label>
                            <input
                                type="text"
                                value={name}
                                onChange={(e) => setName(e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                                required
                            />
                        </div>

                        {/* Email */}
                        <div>
                            <label className="block text-sm font-medium mb-1">Email</label>
                            <input
                                type="email"
                                value={email}
                                onChange={(e) => setEmail(e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                                required
                            />
                        </div>

                        {/* Phone */}
                        <div>
                            <label className="block text-sm font-medium mb-1">Phone</label>
                            <input
                                type="text"
                                value={phone}
                                onChange={(e) => setPhone(e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                            />
                        </div>

                        {/* Role */}
                        <div>
                            <label className="block text-sm font-medium mb-1">Role</label>
                            <select
                                value={role}
                                onChange={(e) => setRole(e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                            >
                                <option value="guest">Guest</option>
                                <option value="host">Host</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div>
                            <label className="block text-sm font-medium mb-1">Password</label>
                            <input
                                type="password"
                                value={password}
                                onChange={(e) => setPassword(e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                                placeholder="Leave empty to keep current password"
                            />
                            {errors.password && <p className="text-red-500 text-sm mt-1">{errors.password}</p>}
                            </div>

                            <div>
                            <label className="block text-sm font-medium mb-1">Confirm Password</label>
                            <input
                                type="password"
                                value={passwordConfirmation}
                                onChange={(e) => setPasswordConfirmation(e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                                placeholder="Leave empty to keep current password"
                            />
                            {errors.password_confirmation && <p className="text-red-500 text-sm mt-1">{errors.password_confirmation}</p>}
                        </div>


                        {/* Profile Image */}
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
                        </div>

                        <div className="flex justify-end space-x-3">
                            <button
                                type="button"
                                onClick={() => router.get("/users")}
                                className="border px-4 py-2 rounded-lg"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                className="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700"
                            >
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </SidebarInset>
            <Toaster position="top-right" />
        </SidebarProvider>
    );
}
