import React, { useState, useMemo } from "react";
import { MoreHorizontal } from "lucide-react";
import { router } from "@inertiajs/react";

export default function DynamicDataTable({ data, columns, editRoute, deleteRoute }) {
    const [search, setSearch] = useState("");
    const [sortConfig, setSortConfig] = useState({ key: null, direction: "asc" });
    const [currentPage, setCurrentPage] = useState(1);
    const [openMenuId, setOpenMenuId] = useState(null); 
    const itemsPerPage = 8;

    // 🔍 Filter
    const filteredData = useMemo(() => {
        if (!search) return data;
        return data.filter((row) =>
            Object.values(row)
                .join(" ")
                .toLowerCase()
                .includes(search.toLowerCase())
        );
    }, [data, search]);

    // 🔽 Sort
    const sortedData = useMemo(() => {
        if (!sortConfig.key) return filteredData;
        return [...filteredData].sort((a, b) => {
            const aVal = a[sortConfig.key];
            const bVal = b[sortConfig.key];
            if (aVal < bVal) return sortConfig.direction === "asc" ? -1 : 1;
            if (aVal > bVal) return sortConfig.direction === "asc" ? 1 : -1;
            return 0;
        });
    }, [filteredData, sortConfig]);

    // 📄 Pagination
    const totalPages = Math.ceil(sortedData.length / itemsPerPage);
    const paginatedData = sortedData.slice(
        (currentPage - 1) * itemsPerPage,
        currentPage * itemsPerPage
    );

    const handleSort = (key) => {
        setSortConfig((prev) => ({
            key,
            direction: prev.key === key && prev.direction === "asc" ? "desc" : "asc",
        }));
    };

    const handleEdit = (id) => {
        router.get(`${editRoute}/${id}/edit`);
    };

    const handleDelete = (id) => {
        if (confirm("Are you sure you want to delete this item?")) {
            router.delete(`${deleteRoute}/${id}`);
        }
    };

    const toggleMenu = (id) => {
        setOpenMenuId((prev) => (prev === id ? null : id));
    };

    return (
        <div className="bg-white shadow-md rounded-lg p-4">
            {/* 🔍 Search */}
            <div className="flex justify-between mb-3">
                <input
                    type="text"
                    value={search}
                    onChange={(e) => setSearch(e.target.value)}
                    placeholder="Search..."
                    className="border rounded-lg px-3 py-2 w-1/3"
                />
            </div>

            {/* 📊 Table */}
            <table className="min-w-full border border-gray-200 rounded-lg">
                <thead className="bg-gray-100">
                    <tr>
                        {columns.map((col) => (
                            <th
                                key={col}
                                className="text-left px-4 py-2 cursor-pointer select-none"
                                onClick={() => handleSort(col)}
                            >
                                {col.charAt(0).toUpperCase() + col.slice(1)}
                                {sortConfig.key === col ? (
                                    sortConfig.direction === "asc" ? " ▲" : " ▼"
                                ) : null}
                            </th>
                        ))}
                        <th className="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {paginatedData.map((row) => (
                        <tr key={row.id} className="border-t hover:bg-gray-50 transition">
                            {columns.map((col) => (
                                <td key={col} className="px-4 py-2">
                                    {row[col]}
                                </td>
                            ))}

                            {/* ⋯ Menu Button */}
                            <td className="px-4 py-2 text-right relative">
                                <button
                                    onClick={() => toggleMenu(row.id)}
                                    className="p-2 hover:bg-gray-100 rounded-full"
                                >
                                    <MoreHorizontal className="w-5 h-5" />
                                </button>

                                {openMenuId === row.id && (
                                    <div className="absolute right-2 mt-2 w-32 bg-white border rounded-lg shadow-lg z-10">
                                        <button
                                            onClick={() => handleEdit(row.id)}
                                            className="block w-full px-4 py-2 text-left hover:bg-gray-100"
                                        >
                                            Edit
                                        </button>
                                        <button
                                            onClick={() => handleDelete(row.id)}
                                            className="block w-full px-4 py-2 text-left text-red-600 hover:bg-red-50"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                )}
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>

            {/* 📄 Pagination Controls */}
            <div className="flex justify-end mt-4 space-x-2">
                <button
                    disabled={currentPage === 1}
                    onClick={() => setCurrentPage((p) => p - 1)}
                    className="px-3 py-1 border rounded disabled:opacity-50"
                >
                    Prev
                </button>
                <span className="px-2">
                    Page {currentPage} of {totalPages}
                </span>
                <button
                    disabled={currentPage === totalPages}
                    onClick={() => setCurrentPage((p) => p + 1)}
                    className="px-3 py-1 border rounded disabled:opacity-50"
                >
                    Next
                </button>
            </div>
        </div>
    );
}
