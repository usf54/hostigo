import React, { useEffect } from "react";
import { useForm } from "@inertiajs/react";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";
import toast, { Toaster } from "react-hot-toast";
import { usePage } from "@inertiajs/react";

export default function CreateAmenity() {
    const { flash } = usePage().props; // flash messages from backend

    // Show toast notifications
    useEffect(() => {
        if (flash?.success) toast.success(flash.success);
        if (flash?.error) toast.error(flash.error);
    }, [flash]);

    // Inertia form
    const { data, setData, post, errors, processing } = useForm({
        name: "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        // Simple way: POST to Laravel route directly
        post("/amenities", {
            onSuccess: () => {
                toast.success("Amenity created successfully!");
            },
            onError: () => {
                toast.error("Failed to create amenity.");
            },
        });
    };

    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />
                <div className="p-6">
                    <h1 className="text-2xl font-semibold mb-4">Create Amenity</h1>

                    <form
                        onSubmit={handleSubmit}
                        className="max-w-md bg-white p-6 rounded-lg shadow"
                    >
                        <div className="mb-4">
                            <label
                                htmlFor="name"
                                className="block text-sm font-medium text-gray-700"
                            >
                                Name
                            </label>
                            <input
                                type="text"
                                id="name"
                                value={data.name}
                                onChange={(e) => setData("name", e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            />
                            {errors.name && (
                                <p className="text-red-500 text-sm mt-1">{errors.name}</p>
                            )}
                        </div>

                        <button
                            type="submit"
                            disabled={processing}
                            className="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700"
                        >
                            {processing ? "Saving..." : "Save Amenity"}
                        </button>
                    </form>
                </div>
            </SidebarInset>

            <Toaster position="top-right" />
        </SidebarProvider>
    );
}
