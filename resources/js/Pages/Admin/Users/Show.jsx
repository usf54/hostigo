import React from "react";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";
import { usePage, router } from "@inertiajs/react";

export default function ShowUser() {
    const { user } = usePage().props;

    const roleColors = {
        admin: "bg-red-100 text-red-800",
        host: "bg-blue-100 text-blue-800",
        guest: "bg-green-100 text-green-800",
    };

    const roleBadge = roleColors[user.role] || "bg-gray-100 text-gray-800";

    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />
                <div className="p-6 max-w-5xl mx-auto">
                    {/* Header */}
                    <div className="flex justify-between items-center mb-6">
                        <h1 className="text-3xl font-bold text-gray-800">{user.name}</h1>
                        <button
                            onClick={() => router.get("/users")}
                            className="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-sm"
                        >
                            ← Back
                        </button>
                    </div>

                    {/* Two-column layout */}
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {/* Left panel: Avatar + Role */}
                        <div className="bg-white shadow rounded-lg p-6 flex flex-col items-center space-y-4">
                            <img
                                src={user.image ? (user.image.startsWith("http") ? user.image : `/storage/${user.image}`) : "/default-avatar.png"}
                                alt={user.name}
                                className="w-32 h-32 rounded-full object-cover border border-gray-300"
                            />
                            <span className={`px-4 py-2 rounded-full text-sm font-medium ${roleBadge}`}>
                                {user.role}
                            </span>
                        </div>

                        {/* Right panel: Details */}
                        <div className="md:col-span-2 bg-white shadow rounded-lg p-6 space-y-4">
                            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <h2 className="text-lg font-semibold text-gray-700">Email</h2>
                                    <p className="text-gray-600">{user.email}</p>
                                </div>
                                <div>
                                    <h2 className="text-lg font-semibold text-gray-700">Phone</h2>
                                    <p className="text-gray-600">{user.phone || "N/A"}</p>
                                </div>
                                <div>
                                    <h2 className="text-lg font-semibold text-gray-700">Created At</h2>
                                    <p className="text-gray-600">{new Date(user.created_at).toLocaleDateString()}</p>
                                </div>
                            </div>

                            <div className="flex justify-end mt-4">
                                <button
                                    onClick={() => router.get(`/users/${user.id}/edit`)}
                                    className="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700"
                                >
                                    Edit User
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </SidebarInset>
        </SidebarProvider>
    );
}
