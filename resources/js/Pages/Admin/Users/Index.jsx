import React from "react";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";
import { usePage, router } from "@inertiajs/react";
import DynamicDataTable from "@/components/DynamicDataTable";

export default function Users() {
    const { users } = usePage().props;

    const flattenedUsers = users.map((u) => {
        let roleBadge = "bg-gray-200 text-gray-800";
        if (u.role === "admin") roleBadge = "bg-red-200 text-red-800";
        else if (u.role === "host") roleBadge = "bg-blue-200 text-blue-800";
        else if (u.role === "guest") roleBadge = "bg-green-200 text-green-800";

        return {
            id: u.id,
            avatar: (
                <img
                    src={u.image ? (u.image.startsWith("http") ? u.image : `/storage/${u.image}`) : "/default-avatar.png"}
                    alt={u.name}
                    className="w-10 h-10 rounded object-cover border border-gray-300"
                />
            ),
            name: u.name,
            email: u.email,
            phone: u.phone || "N/A",
            role: <span className={`px-2 py-1 rounded-full text-sm ${roleBadge}`}>{u.role}</span>,
            created_at: u.created_at,
        };
    });

    const columns = flattenedUsers.length ? Object.keys(flattenedUsers[0]) : [];

    const columnLabels = {
        id: "ID",
        avatar: "Avatar",
        name: "Name",
        email: "Email",
        phone: "Phone",
        role: "Role",
        created_at: "Created At",
    };

    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />
                <div className="p-6">
                    <div className="flex justify-between items-center mb-4">
                        <button
                            onClick={() => router.get("/users/create")}
                            className="px-4 py-2 bg-blue-600 text-white"
                        >
                            Add User
                        </button>
                    </div>
                    <h1 className="text-2xl font-semibold mb-4">Users</h1>
                    <p className="text-slate-600 mb-6">
                        Here you can manage all users.
                    </p>

                    <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
                        <DynamicDataTable
                            data={flattenedUsers}
                            columns={columns}
                            showRoute="/users"
                            editRoute="/users"
                            deleteRoute="/users"
                            columnLabels={columnLabels}
                        />
                    </div>
                </div>
            </SidebarInset>
        </SidebarProvider>
    );
}
