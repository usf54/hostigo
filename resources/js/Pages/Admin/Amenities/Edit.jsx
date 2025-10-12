import React, { useState, useEffect } from "react";
import { usePage, router } from "@inertiajs/react";
import toast, { Toaster } from "react-hot-toast";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";

export default function Edit() {
    const { amenity, flash } = usePage().props; // Laravel passes { amenity, flash }
    const [name, setName] = useState(amenity.name || "");

    useEffect(() => {
        if (flash?.success) toast.success(flash.success);
        if (flash?.error) toast.error(flash.error);
    }, [flash]);

    const handleSubmit = (e) => {
        e.preventDefault();
        router.put(`/amenities/${amenity.id}`, {name});
    };

    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />

                <div className="p-6">
                    <h1 className="text-2xl font-semibold mb-4">Edit Amenity</h1>

                    <form
                        onSubmit={handleSubmit}
                        className="bg-white shadow-md rounded-lg p-6 w-full md:w-1/2"
                    >
                        <div className="mb-4">
                            <label className="block text-sm font-medium text-gray-700 mb-1">
                                Name
                            </label>
                            <input
                                type="text"
                                name="name"
                                value={name}
                                onChange={(e) => setName(e.target.value)}
                                className="w-full border rounded-lg px-3 py-2"
                                required
                            />
                        </div>

                        <div className="flex justify-end space-x-3">
                            <button
                                type="button"
                                onClick={() => router.get("/amenities")}
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
