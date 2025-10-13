import React, { useEffect } from "react";
import { useForm } from "@inertiajs/react";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";
import toast, { Toaster } from "react-hot-toast";
import { usePage } from "@inertiajs/react";

export default function CreateProperty() {
    const { flash, amenities, hosts } = usePage().props; // hosts passed from backend

    useEffect(() => {
        if (flash?.success) toast.success(flash.success);
        if (flash?.error) toast.error(flash.error);
    }, [flash]);

    const { data, setData, post, errors, processing } = useForm({
        user_id: "",
        title: "",
        description: "",
        price_per_night: "",
        address: "",
        city: "",
        country: "",
        latitude: "",
        longitude: "",
        max_guests: 1,
        amenities: [],
        images: [],
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post("/properties", {
            onSuccess: () => toast.success("Property created successfully!"),
            onError: () => toast.error("Failed to create property."),
        });
    };

    const handleFileChange = (e) => {
        setData("images", Array.from(e.target.files));
    };

    const handleAmenityChange = (amenityId) => {
        if (data.amenities.includes(amenityId)) {
            setData(
                "amenities",
                data.amenities.filter((id) => id !== amenityId)
            );
        } else {
            setData("amenities", [...data.amenities, amenityId]);
        }
    };

    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />
                <div className="p-6">
                    <h1 className="text-2xl font-semibold mb-4">Create Property</h1>

                    <form
                        onSubmit={handleSubmit}
                        className="max-w-3xl bg-white p-6 rounded-lg shadow space-y-4"
                    >
                        {/* Host Dropdown */}
                        <div>
                            <label className="block text-sm font-medium text-gray-700 mb-1">
                                Host
                            </label>
                            <select
                                value={data.user_id}
                                onChange={(e) => setData("user_id", e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                required
                            >
                                <option value="">Select a host</option>
                                {hosts.map((host) => (
                                    <option key={host.id} value={host.id}>
                                        {host.name} (ID: {host.id})
                                    </option>
                                ))}
                            </select>
                            {errors.user_id && (
                                <p className="text-red-500 text-sm mt-1">{errors.user_id}</p>
                            )}
                        </div>

                        {/* Title & Description */}
                        <div>
                            <label className="block text-sm font-medium text-gray-700">
                                Title
                            </label>
                            <input
                                type="text"
                                value={data.title}
                                onChange={(e) => setData("title", e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            />
                            {errors.title && <p className="text-red-500 text-sm">{errors.title}</p>}
                        </div>

                        <div>
                            <label className="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <textarea
                                value={data.description}
                                onChange={(e) => setData("description", e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            />
                            {errors.description && <p className="text-red-500 text-sm">{errors.description}</p>}
                        </div>

                        {/* Price, Max Guests, Latitude, Longitude */}
                        <div className="grid grid-cols-2 gap-4">
                            <div>
                                <label className="block text-sm font-medium text-gray-700">
                                    Price per Night
                                </label>
                                <input
                                    type="number"
                                    value={data.price_per_night}
                                    onChange={(e) => setData("price_per_night", e.target.value)}
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                />
                                {errors.price_per_night && <p className="text-red-500 text-sm">{errors.price_per_night}</p>}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700">
                                    Max Guests
                                </label>
                                <input
                                    type="number"
                                    min={1}
                                    value={data.max_guests}
                                    onChange={(e) => setData("max_guests", e.target.value)}
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                />
                                {errors.max_guests && <p className="text-red-500 text-sm">{errors.max_guests}</p>}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700">
                                    Latitude
                                </label>
                                <input
                                    type="number"
                                    step="0.00000001"
                                    value={data.latitude}
                                    onChange={(e) => setData("latitude", e.target.value)}
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                />
                                {errors.latitude && <p className="text-red-500 text-sm">{errors.latitude}</p>}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700">
                                    Longitude
                                </label>
                                <input
                                    type="number"
                                    step="0.00000001"
                                    value={data.longitude}
                                    onChange={(e) => setData("longitude", e.target.value)}
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                />
                                {errors.longitude && <p className="text-red-500 text-sm">{errors.longitude}</p>}
                            </div>
                        </div>

                        {/* City, Country, Address */}
                        <div className="grid grid-cols-2 gap-4">
                            <div>
                                <label className="block text-sm font-medium text-gray-700">City</label>
                                <input
                                    type="text"
                                    value={data.city}
                                    onChange={(e) => setData("city", e.target.value)}
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                />
                                {errors.city && <p className="text-red-500 text-sm">{errors.city}</p>}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700">Country</label>
                                <input
                                    type="text"
                                    value={data.country}
                                    onChange={(e) => setData("country", e.target.value)}
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                />
                                {errors.country && <p className="text-red-500 text-sm">{errors.country}</p>}
                            </div>
                        </div>

                        <div>
                            <label className="block text-sm font-medium text-gray-700">Address</label>
                            <input
                                type="text"
                                value={data.address}
                                onChange={(e) => setData("address", e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            />
                            {errors.address && <p className="text-red-500 text-sm">{errors.address}</p>}
                        </div>

                        {/* Amenities */}
                        <div>
                            <label className="block text-sm font-medium text-gray-700 mb-1">Amenities</label>
                            <div className="flex flex-wrap gap-2">
                                {amenities.map((amenity) => (
                                    <label key={amenity.id} className="flex items-center gap-1">
                                        <input
                                            type="checkbox"
                                            checked={data.amenities.includes(amenity.id)}
                                            onChange={() => handleAmenityChange(amenity.id)}
                                        />
                                        <span>{amenity.name}</span>
                                    </label>
                                ))}
                            </div>
                        </div>

                        {/* Images */}
                        <div>
                            <label className="block text-sm font-medium text-gray-700">Images</label>
                            <input
                                type="file"
                                multiple
                                onChange={handleFileChange}
                                className="mt-1 block w-full"
                            />
                            {errors.images && <p className="text-red-500 text-sm">{errors.images}</p>}
                        </div>

                        <button
                            type="submit"
                            disabled={processing}
                            className="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700"
                        >
                            {processing ? "Saving..." : "Save Property"}
                        </button>
                    </form>
                </div>
            </SidebarInset>

            <Toaster position="top-right" />
        </SidebarProvider>
    );
}
