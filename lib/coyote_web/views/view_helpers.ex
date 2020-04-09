defmodule CoyoteWeb.ViewHelpers do
  @moduledoc """
  Conveniences for all views and templates.
  """

  use Phoenix.HTML

  @pagination_distance 3

  @doc """
  Most of the logic in the pagination function is borrowed from
  [Scrivener.HTML](https://github.com/mgwidmann/scrivener_html/blob/master/lib/scrivener/html.ex).

  The logic here is reimplemented mainly due to the style and ordering changes.
  """
  def pagination_links(%Plug.Conn{} = conn, %Scrivener.Page{} = paginator) do
    content_tag :nav do
      content_tag :span, class: "pagination" do
        add_first(paginator.page_number, @pagination_distance)
        |> add_first_ellipsis(paginator.page_number, @pagination_distance)
        |> page_number_list(paginator.page_number, paginator.total_pages, @pagination_distance)
        |> add_last_ellipsis(paginator.page_number, paginator.total_pages, @pagination_distance)
        |> add_last(paginator.page_number, paginator.total_pages, @pagination_distance)
        |> add_previous(paginator.page_number)
        |> add_next(paginator.page_number, paginator.total_pages)
        |> Enum.map(&render_html(&1, conn))
      end
    end
  end

  defp render_html({:next, page_number}, %Plug.Conn{} = conn) do
    link("NEXT", to: path(conn, page_number))
  end

  defp render_html({:previous, page_number}, %Plug.Conn{} = conn) do
    link("PREVIOUS", to: path(conn, page_number))
  end

  defp render_html({:ellipsis, text}, _conn) do
    content_tag(:span, text)
  end

  defp render_html(page_number, %Plug.Conn{} = conn) when is_integer(page_number) do
    link(page_number, to: path(conn, page_number))
  end

  defp add_first(page_number, distance) when page_number > distance * 2 do
    [1, 2]
  end

  defp add_first(_page_number, _distance) do
    []
  end

  defp add_last(list, page_number, total_pages, distance)
       when page_number + distance < total_pages do
    list ++ [total_pages - 1, total_pages]
  end

  defp add_last(list, _page_number, _total_pages, _distance) do
    list
  end

  defp add_first_ellipsis(list, page_number, distance)
       when page_number > distance * 2 do
    list ++ [{:ellipsis, "..."}]
  end

  defp add_first_ellipsis(list, _page_number, _distance) do
    list
  end

  defp add_last_ellipsis(list, page_number, total_pages, distance)
       when page_number + distance < total_pages do
    list ++ [{:ellipsis, "..."}]
  end

  defp add_last_ellipsis(list, _page_number, _total_distance, _distance) do
    list
  end

  defp add_next(list, page_number, total_pages)
       when page_number != total_pages and page_number < total_pages do
    list ++ [{:next, page_number + 1}]
  end

  defp add_next(list, _page_number, _total) do
    list
  end

  defp add_previous(list, page_number) when page_number != 1 do
    list ++ [{:previous, page_number - 1}]
  end

  defp add_previous(list, _page_number) do
    list
  end

  defp page_number_list(list, page_number, total_pages, distance) do
    list ++
      Enum.to_list(
        beginning_distance(page_number, total_pages, distance)..end_distance(
          page_number,
          total_pages,
          distance
        )
      )
  end

  defp beginning_distance(page_number, _total_pages, distance) when page_number <= distance * 2 do
    1
  end

  defp beginning_distance(page_number, total_pages, distance)
       when page_number <= total_pages - distance * 2 do
    page_number - distance
  end

  defp beginning_distance(page_number, total_pages, distance)
       when page_number > total_pages - distance * 2 do
    total_pages - distance - distance * 2
  end

  # defp beginning_distance(page_number, total_pages, distance) when page_number <= total_pages do
  # page_number - distance
  # end

  # defp beginning_distance(page_number, total_pages, distance) when page_number > total_pages do
  # total_pages - distance
  # end

  defp end_distance(_page_distance, 0, _distance) do
    1
  end

  defp end_distance(page_number, total_pages, distance)
       when page_number >= total_pages - distance * 2 do
    total_pages
  end

  defp end_distance(page_number, _total_pages, distance) do
    page_number + distance
  end

  def path(%Plug.Conn{} = conn, page_number) do
    query_params =
      case page_number > 1 do
        true -> Map.put(conn.query_params, "page", page_number)
        false -> Map.delete(conn.query_params, "page")
      end

    conn.request_path <> "?" <> Plug.Conn.Query.encode(query_params)
  end
end
